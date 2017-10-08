import React from 'react'
import styled from 'styled-components'

export default class ToneSelector extends React.Component {
    render() {
        const Circle = styled.div`
            margin: 20px;
            width: 200px;
            padding-top: 80px;
            height: 200px;
            border-radius: 100%;
            font-size: 16pt;
            -moz-transition: all 0.3s;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
            text-transform: capitalize;
            &.-charcoal {
                background-color: #333333;
                color: #FFFFFF;
            }
            &.-pearl {
                background-color: #eeeeee;
                color: #333333;
            }
            &.-selected {
                border: 5px solid #2980b9;
                font-weight: bold;
            }
            &:hover {
                cursor: pointer;
                -moz-transform: scale(1.1);
                -webkit-transform: scale(1.1);
                transform: scale(1.1);
            }
        `
        return (
            <div className="text-center">
                <Circle 
                    onClick={()=>this.props.select(this.props.style)}
                    className={
                        '-' + this.props.style +
                        (this.props.selected ? " -selected" : "") }>
                    {this.props.style}
                </Circle>  
            </div>  
        )
    }
}