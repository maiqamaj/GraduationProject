<?php
$id = $_GET['id'];
$type = $_GET['type'];
$from = $_SESSION['id'];
if($type == 't'){
    $result = mysqli_query($con,"select CONCAT(first_name,' ',second_name,' ',last_name) as full_name from teacher where id=$id");
    $row = mysqli_fetch_array($result);
}elseif($type =='s'){
    $result = mysqli_query($con,"select CONCAT(first_name,' ',second_name,' ',last_name) as full_name from student where id=$id");
    $row = mysqli_fetch_array($result);
}
elseif($type == 'a'){
    $result = mysqli_query($con,"select username as full_name from admin where id=$id");
    $row = mysqli_fetch_array($result);
}

$result = mysqli_query($con,"select id  from sendbirds where user=$from");
$sendbird = mysqli_fetch_array($result);

if(!$sendbird){
    include 'Sendbird.php';  
    $Sendbird = new Sendbird();
    $Sendbird->createUser($from);
    $Sendbird->updateChannel($from);
    mysqli_query($con,"insert into sendbirds(user) values($from)");
    echo "send ";
}
?>
<div class="container" id="chat-app">
    <div class="content">
        <div style="background-color: white;text-align: center;font-size: 20px">
            <?php echo $row['full_name'] ?>
        </div>
        <div class="messages">
            <ul>
                <li  
                    v-for="item in items"
                    :class="{sent: item.sender_id == sender_id,replies: item.recipient_id == sender_id }"
                 >
                    <img  src="../assets/img/icon.png" alt="">
                    <p v-if="item.type=='text'">
                        {{item.message}}
                    </p>
                    <a :href="item.message" target="_blank">
                    <img 
                        v-if="item.type=='image'" 
                        downloaded
                        class="lazy"
                        :src='item.message'
                        style="height: 200px;width: 200px"
                    />
                    </a>
                    
                    <audio
                        v-if="item.type=='audio'" 
                        controls
                        :src='item.message'
                        >
                            Your browser does not support the
                            <code>audio</code> element.
                    </audio>
                    
                </li>
            </ul> 
        </div> 
        <div class="message-input">
            <div class="wrap">
                <input type="text" placeholder="Write your message..." v-model="newMessage">
                <i
                    @click="toggleRecorder"
                    class="fa fa-microphone"> 
                </i>  
                <i class="fa fa-paperclip attachment" aria-hidden="true" @click="chooseImage()"></i>
                <input id="imageInput" style="display:none" type="file" class="form-control" @change="handleUpload($event.target.files)" />
                <button @click="sendMessage" class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
        </div>
        <div 
            v-if="isRecording"
            class="recording-tools"
        >
            {{recording_timer}}
            <i  @click="stopRecorder"
                class="fa fa-stop" aria-hidden="true"></i>
        </div>
        
    </div>

            
        </div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
<script src="../assets/js/SendBird.min.js"></script>

    <script>


    let sender_id = '<?php echo $_SESSION["id"] ?>';
    let recipient_id = '<?php echo $_GET["id"] ?>';
    
    var app = new Vue({
        el: '#chat-app',
        mounted() {
            this.getMessage()
            //setInterval(this.getMessage, 10000)
        },
        methods: {
            sendMessage() {
                this.items.push({'message': this.newMessage, 'type': 'text', 'sender_id': this.sender_id, 'recipient_id': this.recipient_id})
                let newMessage = this.newMessage;
                axios.post('/includes/api.php?action=saveMsg', {
                    message: this.newMessage,
                    sender_id:this.sender_id,
                    recipient_id:this.recipient_id
                })
                .then(response => {
                    this.newMessage = ''
                    this.scrollToLastMsg()
                    this.sendbirdSendMsg('text',newMessage)
                })
            },
            sendbirdSendMsg(type,message){
                sb.GroupChannel.getChannel('sendbird_group_channel_3965_da92cf3013b272b3b30b8fe802f57d70044f45b4', function(groupChannel, error) {
                    console.log('getChannel: '+groupChannel);
                    if (error) {
                       console.log('error : groupChannel');
                       return;
                    }
                    groupChannel.refresh(function(response, error) {
                        $.each( response.members, function( key, member ) {
                            console.log(member);
                            if(member.userId == recipient_id && member.connectionStatus == 'online'){
                                groupChannel.sendUserMessage(JSON.stringify({'message': message, 'type': type, 'sender_id': sender_id, 'recipient_id': recipient_id}),null,null,function(message, error){
                                if (error) {
                                    return;
                                }
                            });
                            }
                        });

                    });
                });  
            },
            scrollToLastMsg(){
                var height = 0;
                $('.messages li').each(function(i, value){
                    height += parseInt($(this).height());
                });
                height += '';
                $('.messages').animate({scrollTop: height+'30'});
            },       
            handleUpload(files) {
                let formData = new FormData()
                formData.append('photo', files[0]);
                formData.append('sender_id', this.sender_id);
                formData.append('recipient_id', this.recipient_id);
                axios.post('/includes/api.php?action=saveImg', formData)
                .then(response => {
                    this.items.push({'message': response.data.path, 'type': 'image', 'sender_id': this.sender_id, 'recipient_id': this.recipient_id})
                    this.sendbirdSendMsg('image',response.data.path)
                    this.scrollToLastMsg()
                })
            },
            chooseImage(){
                document.getElementById("imageInput").click()
            },
            getMessage() {
                axios.get('/includes/api.php?action=getMesg&admin_id='+this.sender_id+'&teacher_id='+this.recipient_id)
                .then(response => {
                    if(response.data){
                       this.items = response.data    
                    }
                    console.log(response.data)
                    
                })
            },
            toggleRecorder(){
                let audioIN = { audio: true };
                navigator.mediaDevices.getUserMedia(audioIN)
                //.then(function (mediaStreamObj) {
                .then(mediaStreamObj => {
                    this.isRecording = true;
                    this.startRecordingTimer();
//                    let audio = document.querySelector('audio');
//                    if ("srcObject" in audio) {
//                        audio.srcObject = mediaStreamObj;
//                    }
//                    else { // Old version
//                        audio.src = window.URL
//                        .createObjectURL(mediaStreamObj);
//                    }
                    let start = document.getElementById('btnStart');
                    
                   // let stop = document.getElementById('btnStop');
                    //let playAudio = document.getElementById('adioPlay');
                    this.mediaRecorder = new MediaRecorder(mediaStreamObj);
                    this.mediaRecorder.start();
                    let dataArray = [];
                    this.mediaRecorder.ondataavailable = function (ev) {
			dataArray.push(ev.data);
                    }
                    this.mediaRecorder.onstop=() => {
                        this.isRecording = false;
                    //mediaRecorder.onstop = function (ev) {
                        let audioData = new Blob(dataArray,{ 'type': 'audio/mp3;' });
                        dataArray = [];
                        let audioSrc = window.URL.createObjectURL(audioData);
                        //playAudio.src = audioSrc;
                        let formData = new FormData()
                        formData.append('audio',audioData);
                        formData.append('sender_id', this.sender_id);
                        formData.append('recipient_id', this.recipient_id);
                        axios.post('/includes/api.php?action=saveMsgAudio', formData)
                        .then(response => {
                            
                            this.items.push({'message': response.data.path, 'type': 'audio', 'sender_id': this.sender_id, 'recipient_id': this.recipient_id})
                            this.sendbirdSendMsg('audio',response.data.path)
                            this.scrollToLastMsg()
//                            this.items.push({'message': response.data.path, 'type': 'image'})
                           // this.newMessage = 'lllllllllllllllllll'
                        })
                    }

                    
                })
                .catch(function (err) {
                    alert(err.message);
                        console.log(err.name, err.message);
                });
            },
            stopRecorder(){
                this.isRecording = false;
                this.mediaRecorder.stop();
                this.recording_timer=0
                clearInterval(this.interval)
            },
            startRecordingTimer(){
                this.interval = setInterval(() => {
                   this.recording_timer++;
                }, 1000)
            }

        },
        data: {
            newMessage: '',
            img: '',
            items: [],
            sender_id: '<?php echo $_SESSION["id"] ?>',
            recipient_id: '<?php echo $_GET["id"] ?>',
            isRecording:false,
            recording_timer:0,
            mediaRecorder:null,
            interval:null
        }
    })
    
        sb = new SendBird({appId: '1FEEF5D5-377E-4482-9D1A-3FF6A92DAA08'});
        sb.connect(sender_id,function (user, error) {
            if (error) {
              console.log('error: ' + error);
              return;
            }

        });
        var ChannelHandler = new sb.ChannelHandler();
        ChannelHandler.onMessageReceived = function(channel, message){
            console.log(message);
          var sendr_id = message.sender.userId;
          if(sendr_id == recipient_id){
              app.items.push(JSON.parse(message.message));
              app.scrollToLastMsg()
          }
        };
        
        sb.addChannelHandler(sender_id, ChannelHandler);
</script>


<style>
    
    #chat-app{
        width: 50%;
min-width: 360px;
max-width: 1000px;
height: 92vh;
min-height: 300px;
max-height: 720px;
background: #E6EAEA;
    }
    .content {
       // width:calc(100% - 340px);
       //     float: right;
//width: 60%;
height: 100%;
overflow: hidden;
position: relative;
    }
    
     .content .messages {
  height: auto;
  min-height: calc(100% - 93px);
  max-height: calc(100% - 93px);
  overflow-y: scroll;
  overflow-x: hidden;
  background: #E6EAEA;
}
@media screen and (max-width: 735px) {
   .content .messages {
    max-height: calc(100% - 105px);
  }
}
 .content .messages::-webkit-scrollbar {
  width: 8px;
  background: transparent;
}
 .content .messages::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 0, 0.3);
}
 .content .messages ul li {
  display: inline-block;
  clear: both;
  float: left;
  margin: 15px 15px 5px 15px;
  width: calc(100% - 25px);
  font-size: 0.9em;
}
 .content .messages ul li:nth-last-child(1) {
  margin-bottom: 20px;
}
 .content .messages ul li.sent img {
  margin: 6px 8px 0 0;
}
 .content .messages ul li.sent p {
  background: #435f7a;
  color: #f5f5f5;
  float: left;
}

.content .messages ul li.sent audio {
  float: left;
}

 .content .messages ul li.replies img {
  float: right;
  margin: 6px 0 0 8px;
}
 .content .messages ul li.replies p {
  background: #f5f5f5;
  float: right;
}
.content .messages ul li.replies audio {
  float: right;
}
 .content .messages ul li img {
  width: 22px;
  border-radius: 50%;
  float: left;
}
 .content .messages ul li p {
  display: inline-block;
  padding: 10px 15px;
  border-radius: 20px;
  max-width: 205px;
  line-height: 130%;
}
@media screen and (min-width: 735px) {
   .content .messages ul li p {
    max-width: 300px;
  }
}
 .content .message-input {
/*  position: absolute;
  bottom: 0;
  width: 100%;
  z-index: 99;*/
}
 .content .message-input .wrap {
  position: relative;
}
 .content .message-input .wrap input {
  font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
  float: left;
  border: none;
  width: calc(100% - 90px);
  padding: 11px 32px 10px 8px;
  font-size: 0.8em;
  color: #32465a;
}
@media screen and (max-width: 735px) {
   .content .message-input .wrap input {
    padding: 15px 32px 16px 8px;
  }
}
 .content .message-input .wrap input:focus {
  outline: none;
}
 .content .message-input .wrap .attachment {
  position: absolute;
  right: 60px;
  z-index: 4;
  margin-top: 10px;
  font-size: 1.1em;
  color: #435f7a;
  opacity: .5;
  cursor: pointer;
}
 .content .message-input .wrap .fa-microphone {
  position: absolute;
  right: 76px;
  z-index: 4;
  margin-top: 10px;
  font-size: 1.1em;
  color: #435f7a;
  opacity: .5;
  cursor: pointer;
}
@media screen and (max-width: 735px) {
   .content .message-input .wrap .attachment {
    margin-top: 17px;
    right: 65px;
  }
}
 .content .message-input .wrap .attachment:hover {
  opacity: 1;
}
 .content .message-input .wrap button {
  float: right;
  border: none;
  width: 50px;
  padding: 12px 0;
  cursor: pointer;
  background: #32465a;
  color: #f5f5f5;
}
@media screen and (max-width: 735px) {
   .content .message-input .wrap button {
    padding: 16px 0;
  }
}
 .content .message-input .wrap button:hover {
  background: #435f7a;
}
 .content .message-input .wrap button:focus {
  outline: none;
}
.recording-tools{
    display: block;
    width: 100%;
    float: left;
    padding-right:84px;
}
</style>
