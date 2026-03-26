<!DOCTYPE html>
<html>
<head>
    <script src="https://source.zoom.us/3.0.0/zoom-meeting-embedded.umd.min.js"></script>
</head>
<body>

<div id="meetingSDKElement"></div>

<script>
const client = ZoomMtgEmbedded.createClient();

async function startMeeting() {
    const meetingNumber = "84156404481";
    const password = "669464";

    const response = await fetch('/zoom/signature', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            meetingNumber: meetingNumber,
            role: 1
        })
    });

    const data = await response.json();

    client.init({
        zoomAppRoot: document.getElementById('meetingSDKElement'),
        language: 'en-US'
    });

    client.join({
        sdkKey: "{{ config('services.zoom.sdk_key') }}",
        signature: data.signature,
        meetingNumber: meetingNumber,
        password: password,
        userName: "Laravel User"
    });
}

startMeeting();
</script>

</body>
</html>