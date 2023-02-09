/**
 * NAME: Juan Dela Cruz
 */

let obj1; // Used to get the Object name.
let data1; // Used to get the data requested.

const actorInformation = {
  firstName: "Robert",
  lastName: "Downey",
  movies: [
    {
      name: "Iron Man 1",
      characterName: "Tony Stark"
    },
    {
      name: "Iron Man 2",
      characterName: "Tony Stark"
    },
    {
      name: "Iron Man 3",
      characterName: "Tony Stark"
    }
  ]
};

const actressInformation = {
  firstName: "Lara",
  lastName: "Croft",
  movies: [
    {
      name: "Tomb Raider 1",
      characterName: "Lara Croft"
    },
    {
      name: "Tomb Raider 2",
      characterName: "Lara Croft"
    },
    {
      name: "Tomb Raider 3",
      characterName: "Lara Croft"
    },
    {
      name: "Tomb Raider 4",
      characterName: "Lara Croft"
    },
    {
      name: "Tomb Raider 5",
      characterName: "Lara Croft"
    }
  ]
};

function displayDetails(obj, data) // Recieves the Object and the data requested as strings.
{
    var result = "";
    var object = eval(obj);

    key = data;

    if (!(key in object) || object[key] === null || object[key] === undefined)
    {
        throw new Error("Could not get value of " + obj + "." + data);
    }

    if (key === "movies")
    {
        let size = object[key].length;
        for (i = 0; i < size; i++)
        {
            if (i == size - 1)
            {
                result += object[key][i].name + ", " + object[key][i].characterName + ".";
            }
            else
            {
                result += object[key][i].name + ", " + object[key][i].characterName + ", ";
            }
        }
    }
    else
    {
        result = object[key];
    }
    return result;
}

function obj(obj) // Gets the string with the name of the Object on selector change.
{
    let object = document.getElementById(obj); // Gets the ID of the selector.
    obj1 = object.value; // Gets the value of the selector.
}

function data(data) // Gets the string with the data of the requested data on selector change.
{
    let result = document.getElementById("result"); // Gets the ID where the data will be shown.
    let datas = document.getElementById(data); // Gets the ID of the selector.
    data1 = datas.value; // Gets the value of the selector.
    result.innerHTML = displayDetails(obj1, data1); // Calls the function to shows the data, send the name of the Object and the data requested, both strings.
}