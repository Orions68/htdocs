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

/**
 * Write a function called "displayDetails" that accepts 2 arguments,
 * an object which is the actorInformation
 * and a string which is one of the object keys.
 * The function is expected to return the value of the provided key
 * e.g.
 * 		displayDetails(actorInformation, 'firstName')
 * 		return value is "Robert"
 */

function displayDetails(obj, data) // Recieves the Object and the data requested as strings.
{
    let object = eval(obj);
    if (data == "movies") // If the data requested was movies.
    {
        var concat = ""; // Used to concatenate the movies titles and the character interpretated.
        for (i = 0; i < object[data].length; i++) // Loop to the quantity of movies.
        {
            if (i == object[data].length - 1) // If it is the last movie
            {
                concat += `${object[data][i].name}, ${object[data][i].characterName}.`; // Concatenate in the variable concat the last movie with final dot.
            }
            else
            {
                concat += `${object[data][i].name}, ${object[data][i].characterName}, `; // Concatenate in the variable concat the name of the movie and the character name followed by a coma(,).
            }
        }
        return concat; // Returns the variable concat.
    }
    else // If the data requested was the name or the surname of the actor
    {
        return object[data]; // Returns the field data of the Object.
    }
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

/**
 * With the function above, use it to console
 * - firstName
 * - lastName
 * - movies
 */

//code here