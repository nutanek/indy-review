import React from 'react'
import styled from 'styled-components'

export default class SaveButton extends React.Component {
    render() {
        const Button = styled.button`
            &:hover {
                cursor: pointer
            }
        `
        return (
            <Button type="button" className="btn btn-success" onClick={()=>this.props.action()}>
                <i className="fa fa-check"></i> SAVE
            </Button>
        )
    }
}