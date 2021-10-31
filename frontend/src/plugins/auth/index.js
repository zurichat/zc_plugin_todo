import { GetUserInfo } from 'zuricontrol';
import store from '../../store';

export const getLoggedInUser = () => {
  GetUserInfo().then((user) => {
    console.log('user', user);
    store.dispatch('todos/ADD_USER', user);
    store.dispatch('todos/HandleGetTodos');
    return user;
  });
};
