<style>
    
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: radial-gradient(circle at 50% 10%, rgba(100, 181, 246, 0.6), transparent 60%),
                radial-gradient(circle at 70% 90%, rgba(33, 150, 243, 0.7), transparent 80%),
                radial-gradient(circle at 30% 95%, rgba(3, 169, 244, 0.5), transparent 70%);
    overflow: hidden;
}
.container {
    background: rgba(255, 255, 255, 0.9);
    color: #444;
    max-width: 500px;
    width: 100%;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
    position: relative;
}
.header {
    text-align: center;
    margin-bottom: 20px;
}
.header h1 {
    color: #01579b;
}
.header p {
    font-size: 14px;
    color: #555;
}
.form-group {
    margin-bottom: 15px;
}
.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
}
.form-group select,
.form-group input[type="date"] {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ddd;
    outline: none;
    transition: all 0.3s ease;
}
.form-group select:focus,
.form-group input[type="date"]:focus {
    border-color: #0288d1;
}
.btn-book {
    width: 100%;
    padding: 12px;
    background: linear-gradient(to right, #0288d1, #03a9f4);
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s;
}
.btn-book:hover {
    background: linear-gradient(to right, #03a9f4, #0288d1);
}
.success-message {
    display: none;
    text-align: center;
    margin-top: 15px;
    padding: 10px;
    color: #fff;
    background: linear-gradient(to right, #00c853, #64dd17);
    border-radius: 5px;
}
</style>