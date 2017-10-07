import React from 'react'
import styled from 'styled-components'
import logo from './../assets/images/logo.png'
import SidebarMenu from './sidebarMenu'

export default class Sidebar extends React.Component {
    render() {
        const Sidebar = styled.div`
            background-color: #2c3e50;
            overflow-y: auto;
            overflow-x: hidden;
            height: 100vh;
        `;
        const Wrapper = styled.div`
            padding-top: 20px;
        `;
        const Logo = styled.img`
            width: 80%;
        `;

        return (
            <Sidebar>
                <Wrapper className="text-center">
                    <Logo src={logo} />
                </Wrapper>
                <Wrapper>
                    <div className="col-12 font-theme">
                        <SidebarMenu title="หน้าควบคุม" icon="tachometer" link="" />
                        <SidebarMenu title="โลโก้" icon="star" link="logo" />
                        <SidebarMenu title="โทนสี" icon="eyedropper" link="tone" />
                        <SidebarMenu title="สไลด์" icon="image" link="slide" />
                        <SidebarMenu title="เมนู" icon="bars" link="menu" />
                        <SidebarMenu title="โซเชียล" icon="facebook-square" link="social" />
                    </div>
                </Wrapper>
            </Sidebar> 
        )
    }
}