// import axios from "axios";
import movies from "@/minidb/movies.json";

const getMoviesFromFile = (category) => {
  let parsedMovies = movies.filter((movie) => {
    return movie.category === category.name;
  });
  if (category?.type === "SERIE" || category?.type === "COMPILATION") {
    parsedMovies = parsedMovies[0].episodes.map(episode => {
      episode.category = category.name;
      return episode;
    });
    
  } else {
    parsedMovies.forEach((movie) => {
      const groups = movie.episodes.map((episode) => {
        if (episode.groups) return episode.groups;
        return [];
      });
      movie.groups = [].concat(...groups);
    });
  }
  return parsedMovies;
};

export const Movies = (category) => {
  // return axios.create({
  //   baseURL: `http://www.omdbapi.com/?apikey=${process.env.VUE_APP_MOVIEOMB_KEY}&${category}`
  // });
  return getMoviesFromFile(category);
};
