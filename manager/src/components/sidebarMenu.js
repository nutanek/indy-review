import React from 'react'
import styled from 'styled-components'
import { Redirect } from 'react-router-dom';

export default class SidebarMenu extends React.Component {
    constructor() {
        super()
        this.state = {
            redirect: false
        }
    }

    handleOnClick() {
        this.setState({redirect: true});
    }

    render() {
        let { title, icon, link } = this.props

        if (this.state.redirect) {
            return <Redirect push to={ '/' + link } />
        }

        const Menu = styled.div`
            cursor: pointer;
            color: #ffffff;
            font-size: 1.3em;
            padding-top: 10px;
            padding-bottom: 10px;
            .icon {
                margin-left: 20px;
                margin-right: 10px;
            }
        `;

        return (
            <Menu className="row" onClick={()=>this.handleOnClick()}>
                <div className="col-1 icon d-block d-md-none d-lg-block">
                    <i className={'fa fa-' + icon}></i>
                </div>
                <div className="col d-block d-md-none d-lg-block">
                    {title}
                </div> 
            </Menu>
        )
    }
}