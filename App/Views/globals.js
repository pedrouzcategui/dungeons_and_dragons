class API {
  static BASE_URL = "http://localhost/dungeons_and_dragons";

  static test() {
    console.log("Calling from Test");
  }

  static async get(url) {
    try {
      const response = await fetch(this.BASE_URL + url);
      const data = await response.json();
      return data;
    } catch (error) {
      console.error(error);
    }
  }

  static async post(url, data) {
    try {
      const response = await fetch(this.BASE_URL + url, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
          "Content-Type": "application/json",
        },
      });
      return response;
    } catch (error) {
      console.error(error);
    }
  }

  static async put(url, body) {
    try {
      const response = await fetch(this.BASE_URL + url, {
        method: "PUT",
        body: JSON.stringify(body),
        headers: {
          "Content-Type": "application/json",
        },
      });
      const data = await response.json();
      return data;
    } catch (error) {
      console.error(error);
    }
  }

  static async delete(url) {
    try {
      const response = await fetch(this.BASE_URL + url, {
        method: "DELETE",
      });
      const data = await response.json();
      return data;
    } catch (error) {
      console.error(error);
    }
  }
}

class Dice {
  // Static method to simulate a random dice throw between 1 and 20
  static randomThrow() {
    return Math.floor(Math.random() * 20) + 1;
  }

  // Static method to return a fixed value for debugging
  static fixedThrow(value) {
    return value;
  }
}

class GameAudio {
  audio = null;
  filename = null;
  isPlaying = null;

  constructor(fileName) {
    if (fileName) {
      this.filename = fileName;
      this.audio = new Audio(this.filename);
      this.setIsPlaying(false);
    }
  }

  getIsPlaying() {
    return this.isPlaying;
  }

  setIsPlaying(value) {
    this.isPlaying = value;
  }

  loopPlay() {
    if (this.isPlaying) {
      this.audio.pause();
      this.audio.currentTime = 0;
    }
    this.audio.volume = 0.2;
    this.audio.loop = true;
    this.audio.play();
  }

  mute() {
    this.audio.volume = 0;
  }

  pause() {
    if (this.audio) {
      this.audio.pause();
    }
  }

  replay() {
    if (this.audio) {
      this.audio.currentTime = 0;
      this.audio.play();
    }
  }

  lowerVolume() {
    if (this.audio && this.audio.volume > 0) {
      this.audio.volume = Math.max(0, this.audio.volume - 0.1);
    }
  }

  increaseVolume() {
    if (this.audio && this.audio.volume < 1) {
      this.audio.volume = Math.min(1, this.audio.volume + 0.1);
    }
  }
}
