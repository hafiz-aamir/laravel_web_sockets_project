<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @vite('resources/js/app.js')

</body>
</html>

<script>

    setTimeout(() => {
        
        window.Echo.channel('example-channel')
        .listen('testingEvent', (e) => {
            console.log(e);
        });

    }, 200);

</script>