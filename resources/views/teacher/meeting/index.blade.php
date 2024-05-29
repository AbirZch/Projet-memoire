@extends('teacher.layout.app')

@section('content')
    <style>
        html,
        body {
            min-width: 0 !important;
        }

        #zmmtg-root {
            display: none;
            min-width: 0 !important;
        }

        main {
            width: 70%;
            margin: auto;
            text-align: center;
        }

        main button {
            margin-top: 20px;
            background-color: #2D8CFF;
            color: #ffffff;
            text-decoration: none;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 40px;
            padding-right: 40px;
            display: inline-block;
            border-radius: 10px;
            cursor: pointer;
            border: none;
            outline: none;
        }

        main button:hover {
            background-color: #2681F2;
        }
    </style>


    <main>
        <h1>Zoom Meeting SDK Sample JavaScript</h1>

        <!-- For Component View -->
        <div id="meetingSDKElement">
            <!-- Zoom Meeting SDK Rendered Here -->
        </div>

        <div class="iframe-container" style="overflow: hidden; padding-top: 56.25%; position: relative;">
            <iframe allow="microphone; camera"
                style="border: 0; height: 100%; left: 0; position: absolute; top: 0; width: 100%;"
                src="https://success.zoom.us/wc/join/81565731931" frameborder="0"></iframe>
        </div>
        <button onClick="getSignature()">Join Meeting</button>
    </main>
@endsection

@section('scripts')
    <script src="https://source.zoom.us/3.5.2/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/3.5.2/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/3.5.2/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/3.5.2/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/3.5.2/lib/vendor/lodash.min.js"></script>

    <script src="https://source.zoom.us/3.5.2/zoom-meeting-embedded-3.5.2.min.js"></script>
    <script type="text/javascript" src="component-view.js"></script>

    <script>
        const client = ZoomMtgEmbedded.createClient()

        let meetingSDKElement = document.getElementById('meetingSDKElement')

        var authEndpoint = '/signature'
        var sdkKey = {{ env('ZOOM_SDK_KEY') }}
        var meetingNumber = "81565731931"
        var passWord = meeting.password
        var role = 0 // 0: Attendee, 1: Host
        var userName = 'JavaScript'
        var userEmail = ''
        var registrantToken = ''
        var zakToken = ''

        function getSignature() {
            fetch(authEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    meetingNumber: meetingNumber,
                    role: role
                })
            }).then((response) => {
                return response.json()
            }).then((data) => {
                console.log(data)
                startMeeting(data.signature)
            }).catch((error) => {
                console.log(error)
            })
        }

        function startMeeting(signature) {

            client.init({
                zoomAppRoot: meetingSDKElement,
                language: 'en-US',
                patchJsMedia: true
            }).then(() => {
                client.join({
                    signature: signature,
                    sdkKey: sdkKey,
                    meetingNumber: meetingNumber,
                    password: passWord,
                    userName: userName,
                    userEmail: userEmail,
                    tk: registrantToken,
                    zak: zakToken
                }).then(() => {
                    console.log('joined successfully')
                }).catch((error) => {
                    console.log(error)
                })
            }).catch((error) => {
                console.log(error)
            })
        }
    </script>
@endsection
