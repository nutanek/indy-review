import React from 'react'
import Sidebar from './../components/sidebar'
import styled from 'styled-components'

export default class MainLayout extends React.Component {
    render() {
        const Main = styled.div`
            background-color: #f5f5f5;
        `;
        const Wrapper = styled.div`
            padding: 0;
        `;
        const Header = styled.div`
            background-color: #ffffff;
            border-bottom: 1px solid #e6e6e6;
            height: 50px;
        `;
        const Content = styled.div`
            padding-top: 20px;
            padding-bottom: 20px;
            height: calc(100vh - 50px);
            overflow-x: hidden;
            overflow-y: auto;
        `;

        return (
            <Main className="container-fluid">
                <div className="row">
                    <Wrapper className="col-sm-12 col-md-3 col-lg-2">
                        <Sidebar />
                    </Wrapper>
                    <Wrapper className="col">
                        <Header className="col">
                            
                        </Header>
                        <Content className="col">
                            {this.props.children}
                        </Content>
                    </Wrapper>
                </div>
            </Main>
        )
    }
}