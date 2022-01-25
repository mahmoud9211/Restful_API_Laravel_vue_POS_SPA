class Toastermsg{

    successmsg(title){

      return    Toast.fire({
            icon: 'success',
            title: title
          })
        


    }

    errormsg(title){

        return    Toast.fire({
            icon: 'error',
            title: title
          })

        


    }





}

export default Toastermsg = new Toastermsg();