import { useState } from "react";
import '../Styles/Calculator.css'

const Calculator = () =>{
    const [num1, setNum1] = useState("");
    const [num2, setNum2] = useState("");
    const [operation, setOperation] = useState(null);
    const [result, setResult] = useState("");

    const calculate = () =>{
        let input1 = parseFloat(num1);
        let input2 = parseFloat(num2);

        let res;

        switch(operation){
            case '+':
                res = input1 + input2;
                break;
            case '-':
                res = input1 - input2;
                break;
            case '*':
                res = input1 * input2;
                break;
            case '/':
                if(input2 != 0){
                    res = input1 / input2;
                    res = res.toFixed(2);
                }else{
                    res = "Error";
                }
                break;
            default:
                res = "Error";
            
        }
        setResult(res);
    }

    const clear = () =>{
        setNum1("");
        setNum2("");
        setOperation(null);
        setResult("");
    }

    return (
        <body>
            <div className="input-field">
                <input type="number" value={num1} onChange={(e) => setNum1(e.target.value)} placeholder="First Number"/>
                <p>{operation || ""}</p>
                <input type="number" value={num2}  onChange={(e) => setNum2(e.target.value)} placeholder="Second Number"/>

                <div className="operations-pad">
                    <button onClick={() => {setOperation("+")}}>+</button>
                    <button onClick={() => {setOperation("-")}}>-</button>
                    <button onClick={() => {setOperation("*")}}>*</button>
                    <button onClick={() => {setOperation("/")}}>/</button>
                    <button onClick={calculate}>=</button>
                    <button onClick={clear}>C</button>
                </div>

                <p>{result}</p>

            </div>
         </body>
    );
   
};

export default Calculator