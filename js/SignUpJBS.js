function checkPassword(event)
 {
    var pw1 = document.getElementById("pw").value;
    var pw2 = document.getElementById("rpw").value;
    
    if (pw1 !== pw2) {
        alert("Password Mismatch!");
        return false; 
    } else {
        alert("Success!");
        return true;
    }
}
function enableButton()
{
	var bool = document.getElementById("cbox").checked;
	
	if (bool == true)
	{
		document.getElementById("sub").disabled = false;
	}
	else
	{
		document.getElementById("sub").disabled = true;
	}
}
function confirmUpdate() 
{

    return confirm("Are you sure you want to update your information?");
    
}

function deleteAccount() 
{

    if (confirm('Are you sure you want to delete your profile?')) 
    {
        window.location.href = 'delete_user.php';
    }
}