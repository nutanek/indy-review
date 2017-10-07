import React from 'react'
import Sidebar from './../components/sidebar'
import styled from 'styled-components'

export default class MainLayout extends React.Component {
    render() {
        const Main = styled.div`
            background-color:#f2f2f2;
        `;
        const Wrapper = styled.div`
            padding: 0;
        `;
        const Header = styled.div`
            background-color:#ffcc00;
            height: 50px;
        `;
        const Content = styled.div`
            height: calc(100vh - 50px);
        `;


        return (
            <Main className="container-fluid">
                <div className="row">
                    <Wrapper className="col-sm-12 col-md-3 col-lg-2">
                        <Sidebar />
                    </Wrapper>
                    <Wrapper className="col">
                        <Header className="col">
                            ssss
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