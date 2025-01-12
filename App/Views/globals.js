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
      return response;
    } catch (error) {
      console.error(error);
    }
  }
}
