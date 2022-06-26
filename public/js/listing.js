// Listing implementetation
var clients = [
  {
    Name: "Otto Clay",
    Age: 25,
    Country: 1,
    Address: "Ap #897-1459 Quam Avenue",
    Married: false,
  },
  {
    Name: "Connor Johnston",
    Age: 45,
    Country: 2,
    Address: "Ap #370-4647 Dis Av.",
    Married: true,
  },
];

let countries = [
  { Name: "", Id: 0 },
  { Name: "United States", Id: 1 },
  { Name: "Canada", Id: 2 },
  { Name: "United Kingdom", Id: 3 },
];

$("#jsGrid").jsGrid({
  width: "100%",
  height: "400px",
  editing: true,
  sorting: true,
  paging: true,
  data: clients,
  fields: [
    { name: "Name", type: "text", width: 150, validate: "required" },
    { name: "Age", type: "number", width: 50 },
    { name: "Address", type: "text", width: 200 },
    {
      name: "Country",
      type: "select",
      items: countries,
      valueField: "Id",
      textField: "Name",
    },
    { name: "Married", type: "checkbox", title: "Is Married", sorting: false },
    { type: "control" },
  ],
});

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

console.log({ clients });

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
