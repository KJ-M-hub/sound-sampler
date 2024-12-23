<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Web dictaphone</title>
    <link href="styles/app.css" rel="stylesheet" type="text/css">
  </head>
  <body>

    <div class="wrapper pt-24">

      

      <section class="main-controls">
        <canvas class="visualizer" height="60px"></canvas>
        <div id="buttons">
          <button class="record mr-8">Record</button>
          <button class="stop ml-8">Stop</button>
        </div>
      </section>

      <section class="sound-clips p-1"></section>

    </div>
    <script src="{{asset('js/recording.js')}}"></script>

  </body>
</html>