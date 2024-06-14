<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laravel </title>
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/source/assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="/source/assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" href="/source/assets/dest/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="/source/assets/dest/rs-plugin/css/responsive.css">
	<link rel="stylesheet" title="style" href="/source/assets/dest/css/style.css">
	<link rel="stylesheet" href="/source/assets/dest/css/animate.css">
	<link rel="stylesheet" href="/source/assets/dest/css/wc-blocks-style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<link rel="stylesheet" title="style" href="/source/assets/dest/css/huong-style.css"> 
	@yield('css')

</head>
<body>
   
    @include('layout.header')
    @yield('content')
    @include('layout.footer')
    @yield('js')
<!-- Button to open chat -->
<button id="open-chat" class="chat-bubble">Chat</button>

<div id="chat-widget" class="chat-widget">
    <div id="chat-header" class="chat-header">
        <span id="close-chat" class="close-chat">&times;</span>
        <h4>Chat với chúng tôi</h4>
    </div>
    <div id="chat-history" class="chat-history">
        <!-- Lịch sử trò chuyện sẽ được hiển thị ở đây -->
    </div>
    <div class="chat-input-wrapper">
        <textarea id="chat-input" class="form-control" rows="1.5" placeholder="Nhập tin nhắn của bạn"></textarea>
        <button id="send-message" class="btn btn-primary">Gửi</button>
    </div>
</div>

    <!-- include js files -->
	<script src="/source/assets/dest/js/jquery.js"></script>
	<script src="/source/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="/source/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
	<script src="/source/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
	<script src="/source/assets/dest/vendors/animo/Animo.js"></script>
	<script src="/source/assets/dest/vendors/dug/dug.js"></script>
	<script src="/source/assets/dest/js/scripts.min.js"></script>
	<script src="/source/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script src="/source/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script src="/source/assets/dest/js/waypoints.min.js"></script>
	<script src="/source/assets/dest/js/wow.min.js"></script>
	<!--customjs-->
	<script src="/source/assets/dest/js/custom2.js"></script>
	<script>
	$(document).ready(function($) {    
		$(window).scroll(function(){
			if($(this).scrollTop()>150){
			$(".header-bottom").addClass('fixNav')
			}else{
				$(".header-bottom").removeClass('fixNav')
			}}
		)
	})
	// Simulate some messages for demonstration
	var messages = [
		
	];
	// Function to display messages in chat history and scroll to the bottom
	function displayMessages() {
		var chatHistory = document.getElementById('chat-history');
		var shouldScroll = chatHistory.scrollTop + chatHistory.clientHeight === chatHistory.scrollHeight;
	
		chatHistory.innerHTML = ''; // Clear previous messages
	
		messages.forEach(function(message) {
			var messageElement = document.createElement('div');
			messageElement.className = 'message';
			messageElement.innerHTML = '<strong>' + message.sender + ':</strong> ' + message.content;
			chatHistory.appendChild(messageElement);
		});
	
		// Scroll to the bottom if the chat was already scrolled to the bottom before
		if (shouldScroll) {
			chatHistory.scrollTop = chatHistory.scrollHeight;
		}
	}
	
	// Function to handle sending a message
	document.getElementById('send-message').addEventListener('click', function() {
		var messageInput = document.getElementById('chat-input');
		var messageContent = messageInput.value.trim();
	
		if (messageContent !== '') {
			// Add your message to the chat history
			messages.push({ sender: 'Bạn', content: messageContent });
			displayMessages();
	
			// Simulate automatic reply after user's message is displayed
			setTimeout(function() {
				var lastMessage = messages[messages.length - 1];
				if (lastMessage.sender === 'Bạn') { // Check if the last message displayed is from the user
					messages.push({ sender: 'Admin', content: 'Tôi đang xem xét yêu cầu của bạn. Vui lòng đợi một chút.' });
					displayMessages();
				}
			}, 1000);
	
			// Clear input after sending message
			messageInput.value = '';
		}
	});
	
	// Event listener for opening the chat
	document.getElementById("open-chat").addEventListener("click", function() {
		document.getElementById("chat-widget").style.display = "block";
	});
	
	// Event listener for closing the chat
	document.getElementById("close-chat").addEventListener("click", function() {
		document.getElementById("chat-widget").style.display = "none";
	});
	
	// Event listener for sending a message
	document.getElementById('send-message').addEventListener('click', function() {
		var messageInput = document.getElementById('chat-input');
		var messageContent = messageInput.value.trim();
	
		if (messageContent !== '') {
			// Add the message to the chat history
			messages.push({ sender: 'Bạn', content: messageContent });
			displayMessages(); // Display the updated chat history with the new message
			messageInput.value = ''; // Clear the input content
		}
	});
	</script>


	<style>
		/* CSS cho tin nhắn của admin */
	.message.admin {
		text-align: left; /* Căn lề về phía bên trái */
		color: #fff; /* Màu chữ trắng */
		background-color: #007bff; /* Màu nền xanh */
	}
	
	/* CSS cho tên của admin */
	.admin-name {
		font-weight: bold; /* Chữ đậm */
		float: right; /* Đẩy về bên phải */
	}
	
	/* CSS cho tin nhắn của bạn */
	.message.you {
		text-align: right; /* Căn lề về phía bên phải */
		color: #000; /* Màu chữ đen */
		background-color: #f0f0f0; /* Màu nền xám nhạt */
	}
	.chat-widget {
		position: fixed;
		bottom: 30px;
		right: 20px;
		width: 350px;
		height: 400px;
		border-radius: 8px;
		box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
		background-color: #fff;
		z-index: 9999;
		overflow: hidden;
		display: none; /* Hide the chat widget by default */
		/* Remaining CSS styles */
	}
	
	/*
	
	/* CSS cho tiêu đề của khung chat */
	.chat-header {
		padding: 10px;
		background-color: #4267B2;
		color: #fff;
		border-top-left-radius: 8px;
		border-top-right-radius: 8px;
	}
	
	.chat-header h4 {
		margin: 0;
		font-size: 16px;
	}
	
	/* CSS cho lịch sử trò chuyện */
	.chat-history {
		flex: 1; /* Làm cho phần này mở rộng để lấp đầy không gian trống */
		max-height: 300px;
		overflow-y: auto;
		padding: 10px;
	}
	
	
	
	.chat-input-wrapper {
		position: absolute; /* Đặt vị trí tuyệt đối */
		bottom: 0; /* Nằm ở phía dưới cùng */
		left: 0; /* Dọc theo cạnh trái */
		width: 100%; /* Chiều rộng 100% của phần tử cha */
		padding: 10px; /* Khoảng cách nội dung bên trong */
		background-color: #fff; /* Màu nền trắng */
		border-top: 1px solid #ccc; /* Viền trên màu xám nhạt */
		box-shadow: 0px -5px 15px rgba(0, 0, 0, 0.1); /* Đổ bóng phía dưới */
		display: flex; /* Sử dụng flexbox */
		align-items: center; /* Căn giữa theo chiều dọc */
		justify-content: space-between; /* Căn các phần tử ở hai đầu */
	}
	
	#chat-input {
		flex: 1; /* Căn phần nhập tin nhắn ra đúng chiều rộng còn lại */
		margin-right: 10px; /* Khoảng cách phải */
		border: none; /* Không có viền */
		border-bottom: 1px solid #ccc; /* Viền dưới màu xám nhạt */
		padding: 10px 0; /* Khoảng cách nội dung bên trong */
		resize: none; /* Không cho phép thay đổi kích thước */
		outline: none; /* Loại bỏ viền khi focus */
	}
	
	#send-message {
		width: 80px; /* Chiều rộng cố định cho nút gửi */
		border: none; /* Không có viền */
		background-color: #4267B2; /* Màu nền xanh */
		color: #fff; /* Màu chữ trắng */
		border-radius: 5px; /* Bo tròn góc */
		padding: 10px; /* Khoảng cách nội dung bên trong */
		cursor: pointer; /* Con trỏ chuột là bàn tay */
		outline: none; /* Loại bỏ viền khi focus */
	}
	
	#send-message:hover {
		background-color: #2a4b8d; /* Màu nền xanh đậm khi di chuột qua */
	}
	
	
	
	/* CSS cho nút đóng */
	.close-chat {
		position: absolute;
		top: 10px;
		right: 10px;
		color: #fff;
		font-size: 20px;
		cursor: pointer;
	}
	
	/* CSS cho nút Chat */
	.chat-bubble {
		
		position: fixed;
		top: 80%;
		left: 93%;
		background-color: #007bff;
		color: #fff;
		border: none;
		border-radius: 50%;
		width: 60px;
		height: 60px;
		font-size: 16px;
		line-height: 60px;
		text-align: center;
		cursor: pointer;
		z-index: 9999;
		box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.2);
	}
			.order {
			border: 1px solid #ccc;
			border-radius: 5px;
			padding: 15px;
			margin-bottom: 20px;
		}
		
		.order-title {
			margin-top: 0;
			margin-bottom: 10px;
			font-size: 20px;
			color: #333;
		}
		
		.order-details p {
			margin: 8px 0;
		}
		
		.order-details strong {
			font-weight: bold;
		}
		
		.continue-shopping-btn {
			display: inline-block;
			background-color: #007bff;
			color: #fff;
			padding: 10px 20px;
			border-radius: 5px;
			text-decoration: none;
			font-size: 16px;
		}
		
		.continue-shopping-btn:hover {
			background-color: #0056b3;
		}
		
			/* Style for sample order */
		
		
			/* CSS cho phần danh sách điều hướng */
		.woocommerce-MyAccount-navigation {
			background-color: #f8f9fa; /* Màu nền */
			padding: 20px; /* Khoảng cách bên trong */
			border-radius: 8px; /* Bo tròn góc */
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng */
		}
		
		/* CSS cho tiêu đề tài khoản */
		.mm-account {
			margin-bottom: 20px; /* Khoảng cách với phần danh sách điều hướng */
			text-align: center; /* Căn giữa nội dung */
		}
		
		.mm-account-name {
			font-weight: bold; /* Đậm */
			margin-top: 5px; /* Khoảng cách với phần tên tài khoản */
		}
		
		/* CSS cho danh sách điều hướng */
		.mm-page-list {
			list-style: none; /* Loại bỏ dấu hiệu danh sách */
			padding: 0; /* Xóa khoảng cách bên trong */
		}
		
		.mm-page-list li {
			margin-bottom: 10px; /* Khoảng cách giữa các mục */
		}
		
		.mm-page-list li a {
			display: block; /* Hiển thị là khối */
			padding: 10px 0; /* Kích thước lề */
			color: #333; /* Màu chữ */
			text-decoration: none; /* Loại bỏ gạch chân */
		}
		
		.mm-page-list li a:hover {
			background-color: #e9ecef; /* Màu nền khi di chuột qua */
			border-radius: 4px; /* Bo tròn góc */
		}
		
		/* CSS cho phần nội dung */
		.woocommerce-MyAccount-content {
			padding: 20px; /* Khoảng cách bên trong */
		}
		
		/* CSS cho tiêu đề */
		.account-details-head {
			font-size: 24px; /* Kích thước font */
			color: #333; /* Màu chữ */
			margin-bottom: 20px; /* Khoảng cách với nội dung phía dưới */
		}
		
		/* CSS cho thông báo */
		.woocommerce-message {
			margin-bottom: 20px; /* Khoảng cách với nội dung phía dưới */
		}
		
		/* CSS cho nút mua sắm */
		.woocommerce-Button {
			display: inline-block; /* Hiển thị là một khối phần tử */
			padding: 10px 20px; /* Kích thước nút */
			background-color: #007bff; /* Màu nền */
			color: #fff; /* Màu chữ */
			text-decoration: none; /* Loại bỏ gạch chân */
			border: none; /* Không có viền */
			border-radius: 4px; /* Bo góc */
			transition: background-color 0.3s; /* Hiệu ứng chuyển đổi màu nền */
		}
		
		.woocommerce-Button:hover {
			background-color: #0056b3; /* Màu nền khi di chuột qua */
		}
		
		/* CSS cho phần nội dung */
		.woocommerce-MyAccount-content {
			padding: 20px; /* Khoảng cách bên trong */
			background-color: #fff; /* Màu nền */
			border-radius: 8px; /* Bo tròn góc */
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng */
		}
		
		/* CSS cho tiêu đề */
		.account-details-head {
			font-size: 24px; /* Kích thước font */
			color: #333; /* Màu chữ */
			margin-bottom: 20px; /* Khoảng cách với nội dung phía dưới */
		}
		
		/* CSS cho thông báo */
		.woocommerce-message {
			margin-bottom: 20px; /* Khoảng cách với nội dung phía dưới */
		}
		
		/* CSS cho nút mua sắm */
		.woocommerce-Button {
			display: inline-block; /* Hiển thị là một khối phần tử */
			padding: 10px 20px; /* Kích thước nút */
			background-color: #007bff; /* Màu nền */
			color: #fff; /* Màu chữ */
			text-decoration: none; /* Loại bỏ gạch chân */
			border: none; /* Không có viền */
			border-radius: 4px; /* Bo góc */
			transition: background-color 0.3s; /* Hiệu ứng chuyển đổi màu nền */
		}
		
		.woocommerce-Button:hover {
			background-color: #0056b3; /* Màu nền khi di chuột qua */
		}
		/* CSS cho phần nội dung */
		.woocommerce-MyAccount-content {
			padding: 20px; /* Khoảng cách bên trong */
			background-color: #fff; /* Màu nền */
			border-radius: 8px; /* Bo tròn góc */
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng */
		}
		
		/* CSS cho tiêu đề */
		.account-details-head {
			font-size: 24px; /* Kích thước font */
			color: #333; /* Màu chữ */
			margin-bottom: 20px; /* Khoảng cách với nội dung phía dưới */
		}
		
		/* CSS cho thông báo */
		.woocommerce-message {
			margin-bottom: 20px; /* Khoảng cách với nội dung phía dưới */
		}
		
		/* CSS cho nút mua sắm */
		.woocommerce-Button {
			display: inline-block; /* Hiển thị là một khối phần tử */
			padding: 10px 20px; /* Kích thước nút */
			background-color: #007bff; /* Màu nền */
			color: #fff; /* Màu chữ */
			text-decoration: none; /* Loại bỏ gạch chân */
			border: none; /* Không có viền */
			border-radius: 4px; /* Bo góc */
			transition: background-color 0.3s; /* Hiệu ứng chuyển đổi màu nền */
		}
		
		.woocommerce-Button:hover {
			background-color: #0056b3; /* Màu nền khi di chuột qua */
		}
		
		/* CSS cho phần đường dẫn */
		.breadcrumb {
			background-color: transparent; /* Đổi màu nền thành trong suốt */
			margin-bottom: 0; /* Xóa khoảng cách dưới cùng */
		}
		
		.breadcrumb .breadcrumb-item a {
			color: #007bff; /* Màu chữ cho các liên kết */
		}
		
		.breadcrumb .breadcrumb-item.active {
			color: #333; /* Màu chữ cho phần tử đang được chọn */
		}
		
		/* CSS cho phần tiêu đề */
		.bread-title {
			margin-top: 0; /* Xóa khoảng cách trên cùng */
			color: #333; /* Màu chữ */
		}
		
		</style>  
</body>
</html>