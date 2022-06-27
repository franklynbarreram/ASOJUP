let sidebar_link = document.getElementById("listing-link");
sidebar_link.classList.remove("collapsed");
sidebar_link.setAttribute("aria-expanded", true);

let sidebar_options = document.getElementById("listing-options");
sidebar_options.classList.add("show");

document.getElementById("test-btn").onclick = () => {
  $("#jsGrid")
    .jsGrid("insertItem", {
      Name: "Connor Johnston",
      Age: 45,
      Country: 2,
      Address: "Ap #370-4647 Dis Av.",
      Married: true,
    })
    .done(() => {
      console.log("completed");
    });
};

document.getElementById("search").addEventListener("keypress", (e) => {
  if (e.key !== "Enter") {
    return;
  }

  $.ajax({
    // headers: { "X-CSRF-TOKEN": token },
    type: "GET",
    // url: "http://localhost:8000/api/listings/search", // TODO: change base url with an env var
    url: "http://localhost:8000/listings/users/table",
    data: {
      listingId: 1,
    },
    success: (response) => {
      console.log({ response });
      $("#users-list").html(response);
      $("#listing-users-form").modal("show");
    },
    error: (XMLHttpRequest, textStatus, errorThrown) => {
      console.log(XMLHttpRequest);
      console.error({ textStatus, errorThrown });
    },
  });
});
