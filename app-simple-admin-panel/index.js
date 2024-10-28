var amqp = require('amqplib/callback_api');

let message = '';

amqp.connect('amqp://rabbitmq', function(error0, connection) {

    if (error0) {

        throw error0;

    }

    connection.createChannel(function(error1, channel) {
        if (error1) {

            throw error1;

        }

        /* var exchange = 'admin';

        channel.assertExchange(exchange, 'direct', {

            durable: true

        });

        var queue = 'admin';

        channel.assertQueue(queue, {

            durable: true

        }); */

        console.log(" [*] Waiting for messages in %s. To exit press CTRL+C", 'admin');

        channel.bindQueue('admin', 'admin', 'is_admin');

        channel.consume(queue, function(msg) {

            message = msg.content;
            console.log(" [x] Received %s", msg.content);

        }, {

            noAck: true

        });
    });

});
 
/* const express = require('express')
const app = express()

app.get('/', (req, res) => {

  //res.send(message)
  console.log(message)

})

app.listen(3000, () => {

  console.log('Listening on port 3000')

}) */