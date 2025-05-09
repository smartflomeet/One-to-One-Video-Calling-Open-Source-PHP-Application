# Building a 1-to-1 Real-Time Communication Web App with PHP and Web Toolkit

1-to-1 RTC Web App: PHP and Web Toolkit 

Experience a Sample Web App showcasing APIs, designed for building fundamental 1-to-1 RTC (Real-Time Communication) Applications. Develop your skills by hosting this app on your own devices, reducing the need for external servers. 

RTC Applications operate seamlessly on supported web browsers, eliminating the need for extra plugin downloads. 

This basic 1-to-1 Video Chat Application is crafted using HTML, CSS, Bootstrap, JavaScript, jQuery, PHP, and EnxRtc (Web Toolkit) 

>The details of the supported set of web browsers can be found here:
https://doc.smartflomeet.ttns.in/developer/video/browser-compatibility-video/

## 1. Important!

When developing a Client Application with EnxRtc.js make sure to include the updated EnxRtc.js polyfills from https://doc.smartflomeet.ttns.in/developer/video-api/client-api/web-toolkit/ for RTCPeerConnection and getUserMedia. Otherwise your application will not work in web browsers.


## 2. Installation

### 2.1 Pre-Requisites

#### 2.1.1 App Id and App Key

* Create your Application
* Get your App ID and App Key
* Clone this repository `git clone https://github.com/smartflomeet/One-to-One-Video-Calling-Open-Source-PHP-Application.git --recursive`
### Please note `--recursive` option. Repo should be cloned recursively to download `client` app.
* You can copy the app into any sub-directory of hosted website on Apache

#### 2.1.2 SSL Certificates

The Application needs to run on https. So, you need to use a valid SSL certificate for your domain and point your application to use them.

However you may use self-signed Certificate to run this application locally. There are many Web Sites to get a Self-Signed Certificate generated for you, Google it. Few among them are:

* https://letsencrypt.org/
* https://www.sslchecker.com/csr/self_signed
* https://www.akadia.com/services/ssh_test_certificate.html

Alternatively you can create your self-signed certificate as below
```javascript
  sudo openssl req -x509 -newkey rsa:4096 -keyout server.key -out server.crt -days 10000 -nodes
  sudo mv server.crt /etc/ssl/certs/ssl.crt
  sudo mv server.key /etc/ssl/private/ssl.key
```
Enable mod ssl and turn on ssl server
```javascript
  sudo a2enmod ssl
  sudo a2ensite default-ssl
  sudo service apache2 restart
```

#### 2.1.3 Configure

* Before you can run this application, configure the service by editing `api/config.php` file to use your app ID and app key

```javascript
  define("API_URL",	"https://api.smartflomeet.ttns.in/v1");
  define("APP_ID",	"YOUR_APP_ID");
  define("APP_KEY",	"YOUR_APP_KEY");
```

* Configure your application base URL by editing `config.js` file

```
var baseUrl = 'Your Application Base URL';
```

### 2.2 Test video call

* Open a browser and go to `https://localhost:443/path-to-sample-app/client/`. The browser should load the App.
* Go to -> Advanced -> Proceed to localhost
* `Don't have a Room ID? Create One` (it creates a new Room ID) and have it pre-filled
* Store the `Room ID` for future use or share it
* Enter a user `Name` (e.g. test0)
* Select `Join as Moderator`
* `Sign In` and allow access to camera and microphone when prompted to start your first webRTC call
* Open another browser tab and enter `https://localhost:443/path-to-sample-app/client/`
* Enter the same `Room ID` previously created, add a different user `Name` (e.g. test1) and select `Join as Participant` and click `Sign In`
* Now, you should see your own video in both the tabs!

### 2.3 Test screen share

* Once video call started, click on 'Desktop' icon to start screen share.
* Once screen share started, layout for the presenter remain same (side by side video). However screen which is shared by presentor, is displayed to the person on other side by hiding the previous layout (side by side video).
* Click on 'Desktop' icon to again to stop screen share.


## 3 Server API

Server API is a Rest API service meant to be called from Partners' Application Server to provision video enabled
meeting rooms. API Access is given to each Application through the assigned App ID and App Key. So, the App ID and App Key
are to be used as Username and Password respectively to pass as HTTP Basic Authentication header to access Server API.

For this application, the following Server API calls are used:
* https://doc.smartflomeet.ttns.in/developer/video-api/server-api/rooms-route/#create-room - To create room to carry out a video session
* https://doc.smartflomeet.ttns.in/developer/video-api/server-api/rooms-route/#create-token - To create Token for the given Room to join a session

To know more about Server API, go to:
https://doc.smartflomeet.ttns.in/developer/video-api/server-api/


## 4 Client API

Client End Point Application uses Web Toolkit EnxRtc.js to communicate with Servers to initiate and manage RTC Communications.

To know more about Client API, go to:
https://doc.smartflomeet.ttns.in/developer/video-api/client-api/
