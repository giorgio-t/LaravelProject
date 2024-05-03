<!DOCTYPE html>
<html lang="en">
<head>
    <title>Email</title>
</head>
<body>
    <image src="{{asset('/storage/' . $product->getImage())}}">
    <p>Name: {{ $product->getName() }}</p>
    <p>Description: {{ $product->getDescription() }}</p>
    <p>Price: {{ $product->getPrice() }}</p>
</body>
</html>