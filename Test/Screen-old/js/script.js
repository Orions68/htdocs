function screenSize()
{
    var view1 = document.getElementById("view1");
    var view2 = document.getElementById("view2");
    var view3 = document.getElementById("view3");
    var result1 = document.getElementById("height1");
    var result2 = document.getElementById("height2");
    var result3 = document.getElementById("height3");
    var height = window.innerHeight;

    result1.innerHTML = "Size: " + view1.offsetHeight;
    result2.innerHTML = "Size: " + view2.offsetHeight;
    result3.innerHTML = "Size: " + view3.offsetHeight;

    if (view1.offsetHeight > height)
    {
        view1.style.height = view1.offsetHeight + "px";
    }
    else
    {
        view1.style.height = height + "px";
    }

    if (view2 != null)
    {
        if (view2.offsetHeight > height)
        {
            view2.style.height = view2.offsetHeight + "px";
        }
        else
        {
            view2.style.height = height + "px";
        }

        if (view3 != null)
        {
            if (view3.offsetHeight > height)
            {
                view3.style.height = view3.offsetHeight + "px";
            }
            else
            {
                view3.style.height = height + "px";
            }
        }
    }
}