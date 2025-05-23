<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../register/login.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "acilc";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

if (!isset($_GET['client_id'])) {
    echo "لم يتم تحديد مقدم الخدمة.";
    exit;
}

$client_id = intval($_GET['client_id']);

$stmt = $conn->prepare("SELECT * FROM clients WHERE id = ?");
$stmt->bind_param("i", $client_id);
$stmt->execute();
$client_result = $stmt->get_result();

if ($client_result->num_rows === 0) {
    echo "مقدم الخدمة غير موجود.";
    exit;
}

$client = $client_result->fetch_assoc();
$user_email = $_SESSION['email'];
$client_email = $client['email'];
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat with <?= htmlspecialchars($client['adi']) ?></title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #f9f9f9, #ffffff);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .chat-box {
            max-width: 400px;
            width: 100%;
            height: 720px;
            background: #ffffff;
            border: 3px solid #a61c1c;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .chat-header {
            display: flex;
            align-items: center;
            padding: 20px;
            background: linear-gradient(90deg, #a61c1c, #c93030);
            color: #ffffff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .chat-header .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-right: 15px;
            border: 2px solid #ffffff;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }
        .chat-header .user-avatar:hover {
            transform: scale(1.1);
        }
        .chat-header .user-info h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }
        .chat-header .user-info .status {
            font-size: 13px;
            color: #f0f0f0;
            margin-top: 4px;
        }
        #messages {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 25px;
            overflow-y: auto;
            background: #f5f5f5;
        }
        .message {
            display: flex;
            align-items: flex-end;
            margin-bottom: 20px;
            max-width: 75%;
            position: relative;
            padding: 12px 18px;
            border-radius: 18px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
            transition: all 0.3s ease;
        }
        .message:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.18);
        }
        .you {
            background: linear-gradient(135deg, #a61c1c, #c93030);
            color: #ffffff;
            margin-left: auto;
            border-radius: 18px 18px 5px 18px;
        }
        .other {
            background: #ffffff;
            color: #a61c1c;
            margin-right: auto;
            border-radius: 18px 18px 18px 5px;
        }
        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            margin-right: 12px;
            border: 2px solid #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }
        .msg-time {
            position: absolute;
            bottom: 0px;
            font-size: 11px;
            color: #ffffff;
        }
        .you .msg-time {
            right: 12px;
        }
        .other .msg-time {
            left: 12px;
            color: #a61c1c;
        }
        form {
            display: flex;
            padding: 20px;
            background: #ffffff;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
        .message-input-container {
            flex: 1;
            position: relative;
            display: flex;
            align-items: center;
        }
        input[type="text"] {
            width: 100%;
            padding: 14px 60px 14px 20px;
            border-radius: 30px;
            border: 2px solid #a61c1c;
            font-size: 15px;
            outline: none;
            background: #fafafa;
            transition: all 0.3s ease;
        }
        input[type="text"]:focus {
            border-color: #c93030;
            box-shadow: 0 0 12px rgba(201, 48, 48, 0.4);
            background: #ffffff;
        }
        .send-button {
            position: absolute;
            right: 20px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            transition: transform 0.3s, filter 0.3s;
        }
        .send-button:hover {
            transform: scale(1.3);
            filter: brightness(1.2);
        }
        .send-button img {
            width: 28px;
            height: 28px;
            filter: invert(20%) sepia(90%) saturate(2000%) hue-rotate(340deg);
        }
    </style>
</head>
<body>

<div class="chat-box">
    <div class="chat-header">
        <!-- <img src="<?= htmlspecialchars($client['profile_image'] ?: 'default-avatar.png') ?>" class="user-avatar" alt="User Avatar"> -->
         <img src="user.png" alt="" class="user-avatar"> 
        <div class="user-info">
            <h3><?= htmlspecialchars($client['adi']) ?></h3>
            <div class="status">Active now</div>
        </div>
    </div>

    <div id="messages"></div>

    <form id="messageForm">
        <div class="message-input-container">
            <input type="text" name="message" placeholder="Type a message here..." required>
            <button type="submit" class="send-button">
                <img src="https://img.icons8.com/ios-filled/50/000000/paper-plane.png" alt="Send">
            </button>
        </div>
    </form>
</div>

<script>
    var userEmail = "<?php echo $_SESSION['email']; ?>";
    var clientEmail = "<?php echo $client_email; ?>";
    var isInitialLoad = true;
    var lastMessageTime = null;

    function fetchMessages() {
        var messagesContainer = document.getElementById('messages');
        var scrollTop = messagesContainer.scrollTop;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_messages.php?user_email=' + clientEmail, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                var messages = JSON.parse(xhr.responseText);
                messagesContainer.innerHTML = '';

                var hasNewMessage = false;
                if (messages.length > 0) {
                    var latestMessageTime = messages[messages.length - 1].created_at;
                    if (lastMessageTime && latestMessageTime > lastMessageTime) {
                        hasNewMessage = true;
                    }
                    lastMessageTime = latestMessageTime;
                }

                messages.forEach(function (msg) {
                    var messageDiv = document.createElement('div');
                    messageDiv.classList.add('message');
                    messageDiv.classList.add(msg.sender_email === userEmail ? 'you' : 'other');
                    
                    var date = new Date(msg.created_at);
                    var time = date.getHours().toString().padStart(2, '0') + ':' + date.getMinutes().toString().padStart(2, '0');
                    
                    var messageContent = msg.message + '<span class="msg-time">' + time + '</span>';
                    
                    messageDiv.innerHTML = messageContent;
                    messagesContainer.appendChild(messageDiv);
                });

                if (isInitialLoad || hasNewMessage) {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    isInitialLoad = false;
                } else {
                    messagesContainer.scrollTop = scrollTop;
                }
            }
        };
        xhr.send();
    }

    function sendMessage(event) {
        event.preventDefault();
        var messageInput = document.querySelector('input[name="message"]');
        var message = messageInput.value.trim();

        if (message) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'send_message.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    messageInput.value = '';
                    fetchMessages();
                }
            };
            xhr.send('user_email=' + clientEmail + '&message=' + encodeURIComponent(message));
        }
    }

    setInterval(fetchMessages, 1000);
    document.getElementById('messageForm').addEventListener('submit', sendMessage);
    fetchMessages();
</script>

</body>
</html> 