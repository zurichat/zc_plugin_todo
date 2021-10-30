import axios from 'axios';

/*              function to get all todos              */
export const getAllTodos = async (userId, orgId) => await axios.get(`user-todo?user_id=${userId}&organisation_id=${orgId}`);
// .then(response => {
//     console.log(response.data.data);
//     let todos = response.data.data
//     return todos
// })
// .catch(error => {
//     if (error.response) {
//         console.warn(error.response.data);
//     } else if (error.request) {
//         // The request was made but no response was received
//         console.log(error.request);
//     } else {
//         // Something happened in setting up the request that triggered the Error
//         console.log('Error', error.message);
//     }
//     console.log(error.config)
// })

export const createTodo = async (orgId, data) => {
  axios.post(`/create-todo?organisation_id=${orgId}`, data);
  // .then(response => {
  //     console.log('todo created ' + response)
  // })
  // .catch(error => {
  //     if (error.response) {
  //         console.warn(error.response.data);
  //     } else if (error.request) {
  //         // The request was made but no response was received
  //         console.log(error.request);
  //     } else {
  //         // Something happened in setting up the request that triggered the Error
  //         console.log('Error', error.message);
  //     }
  //     console.log(error.config)
  // })
};
