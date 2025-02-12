var DEV_MODE = 1,
  baseURL = "https://websdk.sawolabs.com";

class Sawo {
  constructor(e) {
    (this.config = e),
      (this.config.hostName = window.location.hostname),
      (this.config.isFromWP=true),
      (this.iframeID =
        Math.random().toString(36).substring(2, 15) + "sawo-iframe"),
      (this.eventPrefix = Math.random().toString(36).substring(2, 15)),
      window.addEventListener("message", (e) => {
        if (e.origin === baseURL)
          switch (e.data.event) {
            case this.eventPrefix + "LOGIN_SUCCESS":
              this.config.onSuccess && this.config.onSuccess(e.data.payload),
                this.removeForm();
              break;
            case this.eventPrefix + "LOAD_SUCCESS":
              document
                .getElementById(this.iframeID)
                .contentWindow.postMessage(
                  {
                    event: this.eventPrefix + "LOAD_CONFIG",
                    payload: {
                      identifierType: this.config.identifierType,
                      apiKey: this.config.apiKey,
                      hostName: this.config.hostName,
                      isFromWP: this.config.isFromWP
                    },
                  },
                  "*"
                );
              break;
          }
      });
  }
  showForm() {
    var e = document.getElementById(this.config.containerID),
      t = document.createElement("iframe");
    (t.id = this.iframeID),
      (t.style.border = 0), 
      e.appendChild(t),
      (t.style.width = "100%"),
      (t.style.height = "100%"),
      (t.style.overflow = "scroll");
    var i = `${baseURL}/?eventPrefix=${this.eventPrefix}`;
    t.setAttribute("src", encodeURI(i));
  }
  removeForm() {
    document.getElementById(this.iframeID).remove();
  }
}
