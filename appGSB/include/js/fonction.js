function addRow()
		{
		   var arrTables = document.getElementById('tabHorsForfait');
		   var oRows = arrTables.rows;
		   var numRows = oRows.length;

		   var newRow = document.getElementById('tabHorsForfait').insertRow( numRows );
		   var cell1 = newRow.insertCell(0);
		   var cell2 = newRow.insertCell(1);
		   var cell3 = newRow.insertCell(2);
		   var cell4 = newRow.insertCell(3);
		   var cell5 = newRow.insertCell(4);

		   cell1.innerHTML = numRows;
		   cell2.innerHTML = numRows;
		   cell3.innerHTML = numRows;
		   cell4.innerHTML = numRows;
		   cell5.innerHTML = numRows;
		}

document.querySelector("input[type=number]")
.oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))