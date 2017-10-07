import React from 'react'
import styled from 'styled-components'

export default class SidebarMenu extends React.Component {
    render() {
        const Menu = styled.div`
            color: #ffffff;
            font-size: 1.3em;
            > i {
                margin-left: 20px;
                margin-right: 10px;                
            }
        `;

        let { title, icon } = this.props

        return (
            <Menu>
                <i className={'fa fa-' + icon}></i> {title}
            </Menu>
        )
    }
}