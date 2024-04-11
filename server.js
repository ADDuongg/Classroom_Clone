// Import các module cần thiết
import express from 'express';
import http from 'http';
import { Server } from 'socket.io';

// Khởi tạo ứng dụng Express và server HTTP
const app = express();
const server = http.createServer(app);

// Tạo đối tượng Server từ socket.io và kết nối với server HTTP
const io = new Server(server, {
    cors: { origin: "*" }
});

// Xử lý sự kiện khi có kết nối mới từ client
io.on('connection', (socket) => {
    console.log('A user connected');

    // Gửi tin nhắn đến client khi có kết nối mới
    socket.emit('message', 'Hello, new user!');

    // Xử lý sự kiện khi client gửi tin nhắn
    socket.on('chat message', (msg) => {
        // Gửi tin nhắn đến tất cả các client
        io.emit('chat message', msg);
        console.log(msg);
    });

    // Xử lý sự kiện khi một user disconnect
    socket.on('disconnect', () => {
        console.log('User disconnected');
    });
});

// Lắng nghe trên cổng 3001
server.listen(3001, () => {
    console.log('Server running on port 3001');
});
