<html>
<head>
  <meta charset="UTF-8">
  <title>File(s) size</title>
</head>

<body>
  <form name="uploadForm">
    <div>
      <input id="uploadInput" type="file" name="myFiles" multiple>
      selected files: <span id="fileNum">0</span>;
      total size: <span id="fileSize">0</span>
    </div>
    <div><input type="submit" value="Send file"></div>
  </form>
 
  <script>
  function updateSize() {
    let nBytes = 0,
        oFiles = this.files,
        nFiles = oFiles.length;
    for (let nFileId = 0; nFileId < nFiles; nFileId++) {
      nBytes += oFiles[nFileId].size;
    }
    let sOutput = nBytes + " bytes";
    // optional code for multiples approximation
    const aMultiples = ["KiB", "MiB", "GiB", "TiB", "PiB", "EiB", "ZiB", "YiB"];
    for (nMultiple = 0, nApprox = nBytes / 1024; nApprox > 1; nApprox /= 1024, nMultiple++) {
      sOutput = nApprox.toFixed(3) + " " + aMultiples[nMultiple] + " (" + nBytes + " bytes)";
    }
    // end of optional code
    document.getElementById("fileNum").innerHTML = nFiles;
    document.getElementById("fileSize").innerHTML = sOutput;
  }

  document.getElementById("uploadInput").addEventListener("change", updateSize, false);
  </script>
</body>
</html>