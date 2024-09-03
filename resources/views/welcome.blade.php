<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @vite('resources/js/app.js')

    <div id="message">

    </div>

</body>
</html>

<script>

    setTimeout(() => {
        
        window.Echo.channel('example-channel')
        .listen('testingEvent', (e) => {
            console.log(e);
            let h1 = document.createElement('h1');
            let mess = document.getElementById('message');
            h1.innerText = e.message; 
            mess.append(h1);
        });

    }, 200);

</script>