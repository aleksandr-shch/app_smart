function addProduct(id, name, image, category)
{
    if(id > 0 && name.length > 0 && image.length > 0 && category.length > 0)
    {
        let notice = document.getElementById('notice');
        let csrf = document.getElementById("search").querySelector('input[name="_token"]').value;

        if(notice)
        {
            notice.remove();
        }
        const request = new XMLHttpRequest();
        const url = window.location.href+'add_product';
        const params = "id="+id+"&product_name="+name+"&image_url="+image+"&categories="+category+"&_token="+csrf;
        request.open("POST", url, false);
        request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.addEventListener("readystatechange", () =>
        {
            if(request.readyState === 4 && request.status === 200)
            {
                let button = document.getElementById(id);
                let newNotice = document.createElement("div");
                let response = JSON.parse(request.responseText);
                newNotice.innerText = response.message;
                newNotice.setAttribute("id", "notice");

                if(response.success)
                {
                    newNotice.setAttribute("style", "color:green; position: absolute;");
                    button.after(newNotice, button);
                    button.remove();
                }
                else
                {
                    newNotice.setAttribute("style", "color:red;");
                    button.after(newNotice, button);
                }
            }
        });
        request.send(params);
    }
}