import React from 'react'

export default class SaveButton extends React.Component {
    render() {
        return (
            <button type="button" class="btn btn-success">
                <i className="fa fa-check"></i> SAVE
            </button>
        )
    }
}