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
        const Profile = styled.img`
            width: 50%;
            border-radius: 100%;
            border: 3px solid #ffffff;
            &:hover {
                opacity: 0.5;
            }
        `;

        const menu = [
            { title: "Dashboard", icon: "tachometer", link: "" },
            { title: "Logo", icon: "star", link: "logo" },
            { title: "Tones", icon: "eyedropper", link: "tones" },
            { title: "Slider", icon: "image", link: "slider" },
            { title: "Menu", icon: "bars", link: "menu" },
            { title: "Socials", icon: "facebook-square", link: "social" }
        ]

        return (
            <Sidebar>
                <Wrapper className="text-center">
                    <a href={window.config.rootUrl}>
                        <Logo src={logo} />
                    </a>
                </Wrapper>
                <Wrapper className="text-center">
                    <a href={window.config.setting.profile}>
                        <Profile src={window.config.admin.profileImg} />
                    </a>
                </Wrapper>
                <Wrapper>
                    <div className="col-12 font-theme">
                       {
                           menu.map((item, key) => 
                                <SidebarMenu 
                                    key={key}
                                    title={item.title}
                                    icon={item.icon}
                                    link={item.link} />
                           )
                       }
                    </div>
                </Wrapper>
            </Sidebar> 
        )
    }
}