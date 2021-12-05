  //source->  https://stackoverflow.com/questions/34156282/how-do-i-save-json-to-local-text-file
  
  
 new JavascriptDataDownloader({"greetings": "Hello World"}).download();
  
  class JavascriptDataDownloader {
    constructor(data = {}) {
      this.data = data;
    }

    download(type_of = "text/plain", filename = "data.txt") {
      let body = document.body;
      const a = document.createElement("a");
      a.href = URL.createObjectURL(
        new Blob([JSON.stringify(this.data, null, 2)], {
          type: type_of,
        })
      );
      a.setAttribute("download", filename);
      body.appendChild(a);
      a.click();
      body.removeChild(a);
    }
  }