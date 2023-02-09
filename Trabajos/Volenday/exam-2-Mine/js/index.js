/**
* NAME: Juan Dela Cruz
*/

let btn2 = document.getElementById("btn2"); // ID of the second button(person2).
let btn3 = document.getElementById("btn3"); // ID of the third button(calcAvgHeight).

let name1 = document.getElementById("name1"); // ID of name1.
let height1 = document.getElementById("height1"); // ID of height1.
let weight1 = document.getElementById("weight1"); // Id of weight1.

let name2 = document.getElementById("name2"); // ID of name2.
let height2 = document.getElementById("height2"); // ID of height2.
let weight2 = document.getElementById("weight2"); // Id of weight2.

let person1 = ""; // Object person1.
let person2 = ""; // Object person2.
var counter = 0; // Counter.

function getPerson() // This function Call the call Person and creates the Objects persons.
{
    if (counter > 1) // If counter is greater than 1.
    {
        counter = 0; // Counter is equals 0.
    }
    switch (counter) // Switch to counter value.
    {
        case 0: // If counter is 0
          if (name1.value != "" || height1.value != "" || weight1.value != "") // If any of the values is different of "".
          {
              person1 = new Person(name1.value, height1.value, weight1.value); // Call the class Person and assign to person1 the first Object.
          }
          btn2.style.visibility = "visible"; // Make the btn2 visible.
          break; // Gets out of the switch.
        default: // When counter = 1.
          if (name2.value != "" || height2.value != "" || weight2.value != "") // If any of the values is different of "".
          {
              person2 = new Person(name2.value, height2.value, weight2.value); // Call the class Person and assign to person2 the second Object.
          }
          btn3.style.visibility = "visible"; // Make the btn3 visible.
          break; // Gets out of the switch.
    }
    counter++; // Increments counter.
}

function joinIt() // This fucntion joins both objects.
{
  if (person1 != "") // If the first object is different of "".
  {
    if (person2 != "") // If the second object is different of "".
    {
        let data = {person1, person2}; // Asigns to data the Object compound for object1 and object2.
        calcAvgHeight(data); // Calls the calcAvgHeight function, passing the data.
    }
    else // If person2 is empty.
    {
      console.log("Haz enviado datos de la persona 1 pero no de la 2."); // Outputs the message to the console.
    }
  }
  else // If person1 is empty.
  {
    if (person2 != "") // If person2 is not empty.
    {
        console.log("Haz enviado datos de la persona 2 pero no de la 1."); // Outputs the message to the console.
    }
    else // If person2 is empty too.
    {
        calcAvgHeight(null); // Calls the calcAvgHeight function, passing null.
    }
  }
}

//Write a function calcAvgHeight which calculates average person height. The function takes only one argument, which is an object whose properties are instances of a person class created with the following function:

class Person // Class Person
{
    constructor(n, h, w) // The constructor receives three data, name, height and weight.
    {
        this.name = n;
        this.height = h;
        this.weight = w;
    }
}

//Given an object data, return the calculated average height. If there are no persons in the data object, return null and console the output.

/**
For example, the following call should return (174+190)/2=182:

calcAvgHeight({
  Matt: { height: 174, weight: 69 },
  Jason: { height: 190, weight: 103 }
});
*/

function calcAvgHeight(data) // This function claculates the average height.
{
  let result = document.getElementById("result"); // Id of the H2 elemet where the result will be displayed.
  if (data != null) // If data isn't null
  {
      let object = eval(person1);
      let object2 = eval(person2);
      let average = (parseInt(object.height) + parseInt(object2.height)) / 2; // Asigns to average the average height of person1 and person2.
      console.log("Altura de la persona 1: " + object.height); // Outputs the height of person1 to the console.
      console.log("Altura de la persona 2: " + object2.height); // Outputs the height of person2 to the console.
      console.log(average); //  Outputs the average height to the console.
      result.innerHTML = "The Average Height of Person 1: " + object.height + "cm. and Person 2: " + object2.height + "cm. is: " + average + "cm."; // Shows the result in the H2 element.
  }
  else // If data is null
  {
    result.innerHTML = "No has Introducido ningún dato: " + data; // Shows it in the H2 element.
    console.log(data); // Outputs to the console.
  }
  // Calculate average height from received data. If no data, return null.
}