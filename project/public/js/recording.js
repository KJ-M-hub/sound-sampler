// Set up basic variables for app
const record = document.querySelector(".record");
const stop = document.querySelector(".stop");
const soundClips = document.querySelector(".sound-clips");
const canvas = document.querySelector(".visualizer");
const mainSection = document.querySelector(".main-controls");

// Disable stop button while not recording
stop.disabled = true;

// Visualiser setup - create web audio api context and canvas
let audioCtx;
const canvasCtx = canvas.getContext("2d");

// Main block for doing the audio recording
if (navigator.mediaDevices.getUserMedia) {
  console.log("The mediaDevices.getUserMedia() method is supported.");

  const constraints = { audio: true };
  let chunks = [];

  let onSuccess = function (stream) {
    let options = {};
    if (MediaRecorder.isTypeSupported('audio/wav')) {
        options.mimeType = 'audio/wav';
    } else if (MediaRecorder.isTypeSupported('audio/mp3')) {
        options.mimeType = 'audio/mp3';
    } else {
        options.mimeType = 'audio/webm'; // デフォルトの形式
    }
    const mediaRecorder = new MediaRecorder(stream, options);

    visualize(stream);

    record.onclick = function () {
      mediaRecorder.start();
      console.log(mediaRecorder.state);
      console.log("Recorder started.");
      record.style.background = "red";

      stop.disabled = false;
      record.disabled = true;
    };

    stop.onclick = function () {
      mediaRecorder.stop();
      console.log(mediaRecorder.state);
      console.log("Recorder stopped.");
      record.style.background = "";
      record.style.color = "";

      stop.disabled = true;
      record.disabled = false;
    };

    mediaRecorder.onstop = function (e) {
      console.log("Last data to read (after MediaRecorder.stop() called).");

      const clipName = prompt(
        "Enter a name for your sound clip?",
        "My unnamed clip"
      );

      const clipContainer = document.createElement("article");
      const clipLabel = document.createElement("p");
      const audio = document.createElement("audio");
      const buttonContainer = document.createElement("div"); // ボタン用の親要素を作成
      const deleteButton = document.createElement("button");
      const downloadButton = document.createElement("button"); // Downloadボタンを追加

      clipContainer.classList.add("clip");
      audio.setAttribute("controls", "");
      audio.classList.add("w-full", "rounded"); // 追加
      deleteButton.textContent = "削除"; // テキストを"削除"に変更
      deleteButton.className = "delete";
      deleteButton.classList.add("mr-2","w-16","bg-red-400", "rounded"); // 追加
      downloadButton.textContent = "保存"; // テキストを"保存"に変更
      downloadButton.className = "download w-16 ml-4 bg-gray-300 rounded"; // クラスを追加

      if (clipName === null) {
        clipLabel.textContent = "My unnamed clip";
      } else {
        clipLabel.textContent = clipName;
      }

      // ボタン用の親要素にflexクラスを追加
      buttonContainer.classList.add("flex", "justify-end", "mt-2"); // ボタンを右端に揃えるためのクラスを追加
      buttonContainer.appendChild(deleteButton); // ボタンを追加
      buttonContainer.appendChild(downloadButton); // Downloadボタンを追加

      clipContainer.appendChild(audio);
      clipContainer.appendChild(clipLabel);
      clipContainer.appendChild(buttonContainer); // ボタン用の親要素を追加
      soundClips.appendChild(clipContainer);

      audio.controls = true;
      const blob = new Blob(chunks, { type: mediaRecorder.mimeType });
      console.log("Blob type:", blob.type); // 追加
      chunks = [];
      const audioURL = window.URL.createObjectURL(blob);
      audio.src = audioURL;
      console.log("recorder stopped");

      deleteButton.onclick = function (e) {
        e.target.closest(".clip").remove();
      };

      clipLabel.onclick = function () {
        const existingName = clipLabel.textContent;
        const newClipName = prompt("Enter a new name for your sound clip?");
        if (newClipName !== null && newClipName.trim() !== "") { // nullでなく、空でない場合
            clipLabel.textContent = newClipName;
        }
      };

      downloadButton.onclick = function () {
        const formData = new FormData();
        formData.append("clipName", clipName || "My unnamed clip");
        formData.append("audioData", blob, `${clipName || "My unnamed clip"}.webm`);
    
        // サーバーにデータを送信
        fetch('/save-sound', {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
            body: formData,
        })
        .then(async response => {
          if (!response.ok) {
            const text = await response.text();
            throw new Error(text || response.statusText);
          }
          return response.json();
        })
        .then(data => {
            console.log('Success:', data);
            alert('音声が保存されました。');
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('音声の保存に失敗しました。' + error.message);
        });
      };
    };

    mediaRecorder.ondataavailable = function (e) {
      chunks.push(e.data);
    };
  };

  let onError = function (err) {
    console.log("The following error occured: " + err);
  };

  navigator.mediaDevices.getUserMedia(constraints).then(onSuccess, onError);
} else {
  console.log("MediaDevices.getUserMedia() not supported on your browser!");
}

function visualize(stream) {
  if (!audioCtx) {
    audioCtx = new AudioContext();
  }

  const source = audioCtx.createMediaStreamSource(stream);

  const analyser = audioCtx.createAnalyser();
  analyser.fftSize = 2048;
  const bufferLength = analyser.frequencyBinCount;
  const dataArray = new Uint8Array(bufferLength);

  source.connect(analyser);

  draw();

  function draw() {
    const WIDTH = canvas.width;
    const HEIGHT = canvas.height;

    requestAnimationFrame(draw);

    analyser.getByteTimeDomainData(dataArray);

    canvasCtx.fillStyle = "rgb(200, 200, 200)";
    canvasCtx.fillRect(0, 0, WIDTH, HEIGHT);

    canvasCtx.lineWidth = 2;
    canvasCtx.strokeStyle = "rgb(0, 0, 0)";

    canvasCtx.beginPath();

    let sliceWidth = (WIDTH * 1.0) / bufferLength;
    let x = 0;

    for (let i = 0; i < bufferLength; i++) {
      let v = dataArray[i] / 128.0;
      let y = (v * HEIGHT) / 2;

      if (i === 0) {
        canvasCtx.moveTo(x, y);
      } else {
        canvasCtx.lineTo(x, y);
      }

      x += sliceWidth;
    }

    canvasCtx.lineTo(canvas.width, canvas.height / 2);
    canvasCtx.stroke();
  }
}

window.onresize = function () {
  canvas.width = mainSection.offsetWidth;
};

window.onresize();