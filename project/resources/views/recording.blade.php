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
          <button class="record w-24 my-4 mr-8 border border-black rounded-full">Record</button>
          <button class="stop w-24 my-4 ml-8 border border-black rounded-full">Stop</button>
        </div>
      </section>

      <section class="sound-clips p-1"></section>

    </div>
    <script src="{{asset('js/recording.js')}}"></script>

  </body>
</html>