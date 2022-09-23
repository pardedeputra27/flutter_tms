<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flutter Tms</title>
</head>

<style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: linear-gradient(45deg, greenyellow, dodgerblue);
        font-family: sans-serif;
    }
    a { color: #777; } 

    .container-center {
        position: relative;
        padding: 50px 50px;
        background: #fff;
        border-radius: 10px;
    }

    .container-center h1 {
        text-transform: uppercase;
        font-size: 2em;
        padding: 10px;
        color: #52bafd;
        letter-spacing: 5px;
        margin-bottom: 30px;
        font-weight: bold;
        padding-left: 10px;
    }
    .container-center h4 {
        margin-bottom: 2px;
        font-size: 1em;
        border-left: 5px solid yellowgreen;
        font-weight: bold;
        padding-left: 10px;
    }
    .check-list {
        margin: 0;
        padding-left: 1.2rem;
    }

    .check-list li {
        position: relative;
        list-style-type: none;
        padding-left: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .check-list li:before {
        content: '';
        display: block;
        position: absolute;
        left: 0;
        top: -2px;
        width: 5px;
        height: 11px;
        border-width: 0 2px 2px 0;
        border-style: solid;
        border-color: #00a8a8;
        transform-origin: bottom left;
        transform: rotate(45deg);
    }
</style>

<body>
    <div class="container-center">
        <section>
            <div>
                <h1>cte attendance app</h1>
                <h4>APK Android</h4>
                <ul class="check-list">
                    <li><a href="<?=base_url()?>APK_android/CTEapp-armeabi-v7a-release.apk">CTEapp-armeabi-v7a-release.apk</a></li>
                    <li><a href="<?=base_url()?>APK_android/CTEapp-arm64-v8a-release.apk">CTEapp-arm64-v8a-release.apk</a></li>
                    <li><a href="<?=base_url()?>APK_android/CTEapp-x86_64-release.apk">CTEapp-x86_64-release.apk</a></li>
                </ul>
                <h4>APK windows</h4>
                <ul class="check-list">
                    <li><a href="<?=base_url()?>APK_windows/CTEAttendance.zip">CTEAttendance.zip</a></li>
                </ul>
            </div>
        </section>
    </div>

</body>

</html>