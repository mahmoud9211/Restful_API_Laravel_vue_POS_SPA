class Noty {

    success(title)
    {
        new Noty({
            type: 'success',
            text: title,
            layout: 'topRight',
            timeout : 2000
            
        }).show();
    }

    error(title)
    {
        new Noty({
            type: 'error',
            text: title,
            layout: 'topRight',
            timeout : 2000
            
        }).show();
    }




}

export default Noty = new Noty();