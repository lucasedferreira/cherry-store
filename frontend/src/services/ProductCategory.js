import axios from "axios";

const getCategories = async () => {
  return await axios.get("http://localhost:9000/product-category");
};

export const Categories = async () => {
  return (await getCategories()).data;
};
