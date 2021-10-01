import Centrifuge from 'centrifuge';

const realtime = () => {
    console.log('i say i wan sleep');
    const _this = this
    this.centrifuge = new Centrifuge('wss://realtime.zuri.chat/connection/websocket', { debug: true });
    // this.centrifuge.setToken('token');
    console.log('_this.isUser');
    this.centrifuge.on("connect", (ctx) => {
        console.log("connected", ctx);
        this.centrifuge.subscribe("common-room", function(message) {
            // check if auth user id is same a subscriber id
            if (message.data.subscriberId === _this.isUser["0"]._id) {
                //  console.log(2);
                _this.addTodo(message.data.details)
                console.log('hello its centrifugo');
                console.log(message.data.details);
                //  this.centrifuge.subscribe(message.data.channel, function(ctx) {
                //      // handle new message coming from channel "news"
                //      console.log(ctx.data);
                //  });
            }

        });
    });
    this.centrifuge.connect();
}
export default realtime