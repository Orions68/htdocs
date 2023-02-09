function addFlavour(number)
{
	const place = document.getElementById("here");
	
	for (i = 0; i < number; i++)
	{
		const input = document.createElement("input");
		const label = document.createElement("label");
		const br1 = document.createElement("br");
		const br2 = document.createElement("br");
		
		label.innerHTML = " Escribe un Sabor";
		
		input.name = "flavour1";
		input.type = "text";
		
		place.appendChild(input);
		place.appendChild(label);
		place.appendChild(br2);
		place.appendChild(br1);
	}	
}

function giveStyle()
{
    var byte = 210;

    for (i = 0; i < 9; i++)
    {
        let colors = document.getElementById("clase" + i);

        colors.style.background = "rgb(" + byte + ", " + byte + ", "  + byte + ")";
        byte += 5;
    }
}