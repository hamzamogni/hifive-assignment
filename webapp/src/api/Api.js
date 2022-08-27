import axios from "axios";

export default () => {
  let baseURL = "http://localhost:8000/api";

  return axios.create({
    baseURL: baseURL,
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
  });
};
