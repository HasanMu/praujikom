$(function() {

    getData();
    function getData() {
        $.ajax({
            url: "/profile/data",
            method: "GET",
            success: res => {
                const el = $("#edit-data [name]").get();
                const data = res.data;
                let img = res.data.image
                    ? res.data.image
                    : "default-avatar.jpg";

                // Side
                $("#profile-sidebar-name").text(res.data.name);
                $("#profile-sidebar-image")
                    .attr("src", "/assets/images/users/" + img)
                    .attr("alt", res.data.name);

                // Navbar
                $("#profile-navbar-name").text(res.data.name);
                $("#profile-navbar-image")
                    .attr("src", "/assets/images/users/" + img)
                    .attr("alt", res.data.name);

                // Dropdown
                $("#profile-navbar-dropdown-name")
                    .text(res.data.name)
                    .children()
                    .text(res.data.email);
                $("#profile-navbar-dropdown-image")
                    .attr("src", "/assets/images/users/" + img)
                    .attr("alt", res.data.name);

                // Info Alert
                let d = new Date(res.data.created_at);
                let option = {
                    year: "numeric",
                    month: "long",
                    day: "2-digit"
                };
                let dtf = new Intl.DateTimeFormat("id", option);
                let [
                    { value: da },
                    ,
                    { value: mo },
                    ,
                    { value: ye }
                ] = dtf.formatToParts(d);
            }
        });
    }
})
