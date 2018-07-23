<html>
<head>
    <title>Enable or Disable Checkbox on DropDown Selection using jQuery</title>
    <style>
        body, select {
            font:14px Verdana;
        }
    </style>

   <script type = "text/javascript">
function changetextbox()
{
//alert('dfdf');
    if (document.getElementById("mfi_4_a_i").value === "No") {
	//alert("no");
        document.getElementById("sdd").style.display = "none";
    } else {
        document.getElementById("sdd").style.display = "inline-block";
    }
}
</script>
</head>

<body>
<form>
<select id="mfi_4_a_i" name="mfi_4_a_i" onChange="changetextbox();">
    <option>Yes</option>
    <option>No</option>
    <option>No, but planning in future</option>
</select>

<input type="text" name="mfi_4_a_ii" id="sdd" />
</form>
</body>

</html>