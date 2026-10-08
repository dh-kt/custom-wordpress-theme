import requests
import json
from flask import Flask, request, jsonify

app = Flask(__name__)

# WordPress API URL
WP_API_URL = "https://ch758099-wordpress-3d699.tw1.ru/wp-json/my-spec/v1/equipment"

def get_equipment_from_wordpress():
    """Fetch equipment data from WordPress API"""
    try:
        response = requests.get(WP_API_URL)
        if response.status_code == 200:
            data = response.json()
            return data
        else:
            return None
    except Exception as e:
        print(f"Error fetching equipment: {e}")
        return None

def format_equipment_list(equipment_data):
    """Format equipment data into a readable message"""
    if not equipment_data or not equipment_data.get('data'):
        return "Извините, сейчас нет доступной техники."
    
    items = equipment_data['data']
    message = "📋 *Наша техника в наличии:*\n\n"
    
    for i, item in enumerate(items, 1):
        message += f"{i}. *{item['name']}*\n"
        message += f"   💰 {item['price']} ₽/час\n"
        message += f"   ✅ {item['availability']}\n"
        if item.get('image_url'):
            message += f"   🖼️ {item['image_url']}\n"
        message += f"   🔗 {item['permalink']}\n\n"
    
    return message

def format_single_equipment(item):
    """Format a single equipment item"""
    if not item:
        return "Извините, такая техника не найдена."
    
    message = f"🔧 *{item['name']}*\n"
    message += f"💰 Цена: {item['price']} ₽/час\n"
    message += f"✅ Статус: {item['availability']}\n"
    if item.get('description'):
        message += f"📝 {item['description']}\n"
    if item.get('image_url'):
        message += f"🖼️ {item['image_url']}\n"
    message += f"🔗 Подробнее: {item['permalink']}"
    
    return message

def find_equipment_by_name(equipment_data, search_term):
    """Find equipment by name (simple search)"""
    if not equipment_data or not equipment_data.get('data'):
        return None
    
    search_lower = search_term.lower()
    for item in equipment_data['data']:
        if search_lower in item['name'].lower():
            return item
    
    return None

@app.route('/webhook', methods=['POST'])
def webhook():
    """
    Main webhook handler for Bitrix24
    """
    # 1. Get the incoming data
    data = request.json
    print(f"Received: {data}")
    
    # 2. Extract message and user info
    # Note: Bitrix24 sends different data structure
    # We'll adjust this later when we see the actual format
    message_text = data.get('message', {}).get('text', '')
    user_id = data.get('message', {}).get('user_id', 'unknown')
    
    # 3. Check what the user wants
    if not message_text:
        return jsonify({"status": "error", "message": "No message"})
    
    # 4. Fetch equipment from WordPress
    equipment = get_equipment_from_wordpress()
    
    # 5. Process the message
    text_lower = message_text.lower()
    response_text = ""
    
    if "привет" in text_lower or "здравствуй" in text_lower:
        response_text = "👋 Здравствуйте! Я бот для подбора спецтехники. Напишите 'каталог' чтобы увидеть всю технику, или название техники для подробностей."
    
    elif "каталог" in text_lower or "вся техника" in text_lower or "список" in text_lower:
        response_text = format_equipment_list(equipment)
    
    elif text_lower in ["экскаватор", "трактор", "кран", "грейдер", "погрузочная"]:
        # Search for specific equipment
        found_item = find_equipment_by_name(equipment, text_lower)
        if found_item:
            response_text = format_single_equipment(found_item)
        else:
            response_text = f"Извините, я не нашел '{text_lower}'. Напишите 'каталог' чтобы увидеть всю технику."
    
    else:
        response_text = f"🤖 Я понимаю команды: 'каталог', 'экскаватор', 'трактор', 'кран'.\nПопробуйте спросить меня о технике!"
    
    # 6. Return the response
    return jsonify({
        "status": "success",
        "response": response_text,
        "user_id": user_id
    })

@app.route('/health', methods=['GET'])
def health():
    """Health check endpoint"""
    return jsonify({"status": "ok", "message": "Webhook is running!"})

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)