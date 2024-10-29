var amqp = require('amqplib/callback_api');

amqp.connect('amqp://rabbitmq', function(error0, connection) {

        if (error0) {
            throw error0;
        }

        connection.createChannel(function(error1, channel) {

            if (error1) {

                throw error1;

            }

            var exchange = 'admin';

            channel.assertExchange(exchange, 'direct', {

                durable: true

            });

            var queue = 'rpc_admin';

            channel.assertQueue(queue, {

                durable: true

            }); 

            channel.prefetch(1); 
            channel.bindQueue('rpc_admin', 'admin', 'is_admin');


            console.log(' [x] Awaiting RPC requests');

            channel.consume('rpc_admin', function reply(msg) {

                console.log(msg.content);
                console.log(" [x] Received %s", msg.content);
                
                var result = 'Open additional responsibilies for this user!';
          
                channel.sendToQueue(msg.properties.replyTo,
                  Buffer.from(result), {
                    correlationId: msg.properties.correlationId
                  });
          
                channel.ack(msg);
    
            });
            
    })
});

/* const express = require('express');
const path = require('path');

const app = express();

app.engine('html', require('ejs').renderFile);

app.get('/', (req, res) => {
    const books = [
        { title: "The Great Gatsby", author: "F. Scott Fitzgerald" },
        { title: "To Kill a Mockingbird", author: "Harper Lee" },
        { title: "1984", author: "George Orwell" },
    ];
    res.render(path.join(__dirname, 'index.html'), { books });
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
}); */