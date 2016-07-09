var ReplySection = React.createClass({
    getInitialState: function() {
        return {
            replies: []
        }
    },

    componentDidMount: function() {
        this.loadRepliesFromServer();
        setInterval(this.loadRepliesFromServer, 2000);
    },

    loadRepliesFromServer: function() {
        $.ajax({
            url: this.props.url,
            success: function (data) {
                this.setState({replies: data.replies});
            }.bind(this)
        });
    },

    render: function() {
        return (
            <div>
            <div className="notes-container">
            <h2 className="notes-header">Replies</h2>
            <div><i className="fa fa-plus plus-btn"></i></div>
            </div>
            <ReplyList replies={this.state.replies} />
        </div>
        );
    }
});

var ReplyList = React.createClass({
    render: function() {
        var replyNodes = this.props.replies.map(function(reply) {
            return (
                <ReplyBox username={reply.username} avatarUri={reply.avatarUri} date={reply.date} key={reply.id}>{reply.note}</ReplyBox>
            );
        });

        return (
            <section id="cd-timeline">
            {replyNodes}
            </section>
        );
    }
});

var ReplyBox = React.createClass({
    render: function() {
        return (
            <div className="cd-timeline-block">
            <div className="cd-timeline-img">
            <img src={this.props.avatarUri} className="img-circle" alt="Leanna!" />
            </div>
            <div className="cd-timeline-content">
            <h2><a href="#">{this.props.username}</a></h2>
        <p>{this.props.children}</p>
        <span className="cd-date">{this.props.date}</span>
        </div>
        </div>
        );
    }
});

window.ReplySection = ReplySection;
