import React from 'react'
import Sidebar from './../components/sidebar'

export default class MainLayout extends React.Component {
    render() {
        return (
            <div className="container-fluid">
                <div className="row">
                    <div className="col-2">
                        <div className="row">
                            <Sidebar />
                        </div>
                    </div>
                    <div className="col">
                        sss
                    </div>
                </div>
            </div>
        )
    }
}