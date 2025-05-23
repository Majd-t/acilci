<?php
session_start();

if (!isset($_SESSION['email']) ) {
    header("Location: ../register/login.php");
    exit;
}

$client_email = $_SESSION['email'];

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "acilc";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// جلب كل العملاء الذين تواصلوا مع مقدم الخدمة
$stmt = $conn->prepare("
    SELECT DISTINCT 
        CASE 
            WHEN m.sender_email = ? THEN m.receiver_email 
            ELSE m.sender_email 
        END AS user_email,
        u.adi,
        u.soyadi,
        u.profile_image
    FROM messages m
    JOIN users u ON (
        CASE 
            WHEN m.sender_email = ? THEN m.receiver_email 
            ELSE m.sender_email 
        END = u.email
    )
    WHERE m.sender_email = ? OR m.receiver_email = ?
");
$stmt->bind_param("ssss", $client_email, $client_email, $client_email, $client_email);
$stmt->execute();
$clients_result = $stmt->get_result();

$selected_user_email = isset($_GET['user_email']) ? $_GET['user_email'] : null;
$messages_result = null;
$user_info = null;

if ($selected_user_email) {
    // جلب بيانات المستخدم المحدد
    $stmt = $conn->prepare("SELECT adi, soyadi, profile_image FROM users WHERE email = ?");
    $stmt->bind_param("s", $selected_user_email);
    $stmt->execute();
    $user_info = $stmt->get_result()->fetch_assoc();

    // جلب الرسائل بين العميل ومقدم الخدمة المحدد
    $stmt = $conn->prepare("
        SELECT * FROM messages 
        WHERE (sender_email = ? AND receiver_email = ?) 
           OR (sender_email = ? AND receiver_email = ?) 
        ORDER BY created_at ASC
    ");
    $stmt->bind_param("ssss", $selected_user_email, $client_email, $client_email, $selected_user_email);
    $stmt->execute();
    $messages_result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Chats</title>
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
.container {
    display: flex;
    width: 650px;
    height: 720px;
    background: #ffffff;
    border: 3px solid #a61c1c;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    overflow: hidden;
}
.clients-list {
    width: 200px;
    background: #fafafa;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    padding: 20px;
    border-right: 1px solid rgba(0, 0, 0, 0.05);
}
.clients-list a {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    padding: 12px;
    background: #ffffff;
    color: #a61c1c;
    text-decoration: none;
    border-radius: 15px;
    font-size: 15px;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
}
.clients-list a:hover {
    background: #a61c1c;
    color: #ffffff;
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(166, 28, 28, 0.3);
}
.clients-list a.active {
    background: #a61c1c;
    color: #ffffff;
    box-shadow: 0 5px 15px rgba(166, 28, 28, 0.3);
}
.client-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 12px;
    border: 2px solid #ffffff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s;
}
.client-avatar:hover {
    transform: scale(1.1);
}
.chat-section {
    flex: 1;
    display: flex;
    flex-direction: column;
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
    width: 40px;
    height: 40px;
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
<div class="container">
    <div class="clients-list">
        <?php while ($client = $clients_result->fetch_assoc()): ?>
            <a href="?user_email=<?= urlencode($client['user_email']) ?>"
               class="<?= $selected_user_email === $client['user_email'] ? 'active' : '' ?>">
                <!-- <img src="<?= htmlspecialchars($client['profile_image'] ?: 'default-avatar.png') ?>" class="client-avatar" alt="Client Avatar"> -->
                <img src="user.png" alt="Send" class="client-avatar">

                <?= htmlspecialchars($client['adi'] . ' ' . $client['soyadi']) ?>
            </a>
        <?php endwhile; ?>
    </div>

    <div class="chat-section">
        <?php if ($selected_user_email && $messages_result && $user_info): ?>
            <div class="chat-header">
                 <!-- <img src="<?= htmlspecialchars($user_info['profile_image'] ?: 'default-avatar.png') ?>" class="user-avatar" alt="User Avatar"> -->
                 <img src="user.png" alt="Send" class="user-avatar">

                <div class="user-info">
                    <h3><?= htmlspecialchars($user_info['adi'] . ' ' . $user_info['soyadi']) ?></h3>
                    <div class="status">Active now</div>
                </div>
            </div>

            <div id="messages">
                <?php while ($msg = $messages_result->fetch_assoc()): ?>
                    <div class="message <?= $msg['sender_email'] === $client_email ? 'you' : 'other' ?>">
                        <?php if ($msg['sender_email'] !== $client_email): ?>
                            <!-- <img src="<?= htmlspecialchars($user_info['profile_image'] ?: 'default.png') ?>" class="avatar" alt="Avatar"> -->

                        <?php endif; ?>
                        <?= htmlspecialchars($msg['message']) ?>
                        <span class="msg-time">
                            <?php 
                            $date = new DateTime($msg['created_at']);
                            echo $date->format('H:i');
                            ?>
                        </span>
                    </div>
                <?php endwhile; ?>
            </div>

            <form id="messageForm">
                <div class="message-input-container">
                    <input type="text" name="message" placeholder="Type a message here..." required>
                    <button type="submit" class="send-button">
                        <img src="https://img.icons8.com/ios-filled/50/000000/paper-plane.png" alt="Send">
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<script>
    var clientEmail = "<?php echo $_SESSION['email']; ?>";
    var selectedUserEmail = "<?php echo isset($_GET['user_email']) ? $_GET['user_email'] : ''; ?>";
    var isInitialLoad = true;
    var lastMessageTime = null;

    function fetchMessages() {
        var messagesContainer = document.getElementById('messages');
        if (!messagesContainer) return;
        var scrollTop = messagesContainer.scrollTop;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_messages.php?user_email=' + selectedUserEmail, true);
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
                    messageDiv.classList.add(msg.sender_email === clientEmail ? 'you' : 'other');
                    
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
            xhr.send('user_email=' + selectedUserEmail + '&message=' + encodeURIComponent(message));
        }
    }

    setInterval(fetchMessages, 1000);
    document.getElementById('messageForm')?.addEventListener('submit', sendMessage);
    fetchMessages();
</script>
</body>
</html>