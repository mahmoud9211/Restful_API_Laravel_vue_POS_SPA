import AppStorage from "./AppStorage";
import Token from "./Token";



class User{

    responseAfterLogin(res)
    {
        const access_token = res.data.access_token;
        const user_name = res.data.name;

        if(Token.isValid(access_token)){
            AppStorage.store(access_token,user_name)
        }
    }

    hasToken()
    {
        const storeToken = localStorage.getItem('token');

        if(storeToken){
            return Token.isValid(storeToken) ? true : false
        }
        return false
    }

    LoggedIn()
    {
        return this.hasToken()
    }



}

export default User = new User();